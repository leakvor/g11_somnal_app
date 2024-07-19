<?php

namespace App\Http\Controllers\API;

use App\Events\NotificationCreated;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Resources\ShowPostCommentResource;
use App\Models\Image;
use App\Models\Item;
use App\Models\Notification;
use App\Models\Post;
use App\Models\Post_Image;
use App\Models\Post_Image_Item;
use App\Models\Post_Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Traits\uploadImage;
use Mockery\CountValidator\Exception; // Import the uploadImage trait

class PostController extends Controller
{
    use uploadImage;

    // all post
    public function index()
    {
        $posts = Post::where('status', 'pending')
            ->whereNull('company_id')
            ->orderBy('created_at', 'desc')
            ->get();
        $posts = PostResource::collection($posts);
        return response()->json($posts);
    }

    public function sell()
    {
        $posts = Post::where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();
        $posts = PostResource::collection($posts);
        return response()->json($posts);
    }

    // see all of my post
    public function show_post(Request $request)
    {
        // Ensure user is authenticated
        if (!$request->user()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Retrieve authenticated user
        $user = $request->user();

        // Retrieve all posts for the authenticated user with the 'user' relationship loaded
        $posts = Post::where('user_id', $user->id)
            ->with([
                'user',
                'images' => function ($query) {
                    $query->select('post_id', 'image_id');
                },
                'items' => function ($query) {
                    $query->select('post_id', 'item_id');
                }
            ])
            ->orderBy('created_at', 'desc')
            ->get();

        // If no posts found, return 404 error
        if ($posts->isEmpty()) {
            return response()->json(['message' => 'Posts not found'], 404);
        }

        $transformedPosts = PostResource::collection($posts);

        // Return success response with transformed data
        return response()->json(['success' => true, 'data' => $transformedPosts], 200);
    }


    //update
    public function update(Request $request, $id)
    {
        // return $request->user()->id;
        $post = Post::find($id);
        if (!$post) {
            return response()->json(['success' => false, 'message' => 'Post not found'], 404);
        }
        if ($post->user_id !== auth()->id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }
        $post = Post::store($request, $id);
        return response()->json(['success' => true, 'message' => 'Post updated successfully']);
    }
    //destory
    public function destroy($id)
    {
        $post = Post::find($id);
        if (!$post) {
            return response()->json(['success' => false, 'message' => 'Post not found'], 404);
        }
        if ($post->user_id !== auth()->id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }
        $post->delete();
        return response()->json(['success' => true, 'message' => 'Post has been deleted']);
    }

    //show each post of user==================
    public function show_one_post($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['success' => false, 'message' => 'Post not found'], 404);
        }
        $post = new PostResource($post);
        return response()->json(['success' => true, 'data' => $post]);
    }

    // create post with multiple images===============
    public function store(Request $request)
    {
        $request->validate([
            'company_id' => 'nullable|integer',
        ]);

        // Set a default status if not provided
        $user_id = $request->user()->id;
        $status = $request->input('status', 'pending');

        // Create the post
        $post = Post::create([
            'title' => $request->input('title'),
            'company_id' => $request->input('company_id') ?? null,
            'status' => $status,
            'user_id' => $user_id,
        ]);

        if ($request->has('company_id')) {
            // Create notification
            $notification = Notification::create([
                'type' => 'post',
                'post_id' => $post->id,
                'message' => "You have a new post from a user who wants to sell their scrap to your company",
                'status' => 0,
            ]);
            broadcast(new NotificationCreated($notification))->toOthers();
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                try {
                    $ext = $img->getClientOriginalExtension();
                    $imageName = uniqid() . '.' . $ext;
                    $img->move(public_path('uploads'), $imageName);
                    $newImage = Image::create([
                        'image' => $imageName,
                    ]);

                    // Associate the image with the post
                    Post_Image::create([
                        'post_id' => $post->id,
                        'image_id' => $newImage->id,
                    ]);
                } catch (Exception $e) {
                    return response()->json(['error' => 'Error uploading image: ' . $e->getMessage()], 500);
                }
            }
        }

        // Attach items to the post
        $items = explode(',', $request->input('items'));
        foreach ($items as $itemId) {
            if (Item::where('id', $itemId)->exists()) {
                Post_Item::create([
                    'post_id' => $post->id,
                    'item_id' => $itemId,
                ]);
            } else {
                return response()->json(['error' => "Item ID $itemId does not exist"], 422);
            }
        }

        return response()->json(['message' => 'Post created successfully', 'post' => $post], 201);
    }



    //edit post
    public function edit(Request $request, $id)
    {
        // return $request;
        // Get the post
        $post = Post::findOrFail($id);
        // return $post->user_id;
        // Check if the current user is the post owner
        if ($post->user_id != $request->user()->id) {
            return response()->json(['error' => 'You are not authorized to update this post'], 403);
        }

        // Update the post
        $post->update([
            'title' => $request->input('title', $post->title),
            'company_id' => $request->input('company_id', $post->company_id),
            'status' => $request->input('status', $post->status),
            'user_id' => $request->user()->id,
        ]);
        return $post;

        // Handle image updates
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                try {
                    // Check if the image already exists
                    $existingImage = Image::where('image', $image->getClientOriginalName())->first();
                    if ($existingImage) {
                        // Update the existing image
                        $existingImage->update([
                            'image' => $image->getClientOriginalName(),
                        ]);
                        $post->images()->syncWithoutDetaching($existingImage->id);
                    } else {
                        // Create a new image
                        $imageName = $image->getClientOriginalName();
                        $imagePath = $image->storeAs('public/images', $imageName);
                        $newImage = Image::create([
                            'image' => $imageName,
                            // 'path' => Storage::url($imagePath),
                        ]);
                        $post->images()->attach($newImage->id);
                    }
                } catch (Exception $e) {
                    // Handle image upload errors
                    return response()->json(['error' => 'Error uploading image: ' . $e->getMessage()], 500);
                }
            }
        }

        // Handle item updates
        if ($request->input('items')) {
            $items = explode(',', $request->input('items'));
            foreach ($items as $itemId) {
                // Check if the item already exists
                $existingItem = Item::find($itemId);
                if ($existingItem) {
                    // Update the existing item
                    $existingItem->update([
                        'name' => $request->input('item_name'),
                    ]);
                    $post->items()->syncWithoutDetaching($existingItem->id);
                } else {
                    // Create a new item
                    $newItem = Item::create([
                        'name' => $request->input('item_name'),
                    ]);
                    $post->items()->attach($newItem->id);
                }
            }
        }

        return response()->json(['message' => 'Post updated successfully', 'post' => $post], 200);
    }


    //get all post to each company
    public function post_add_to_company(Request $request)
    {
        $company_id = $request->user()->id;
        $posts = Post::where('company_id', $company_id)
            ->where('status', 'pending')
            ->get();
        if (!$posts) {
            return response()->json(['success' => false, 'message' => 'No post found for this company'], 404);
        }
        $posts = PostResource::collection($posts);
        return response()->json(['success' => true, 'data' => $posts]);
    }
    //get all post that company buy
    public function post_buy(Request $request)
    {
        $company_id = $request->user()->id;
        $posts = Post::where('company_id', $company_id)
            ->where('status', 'buy')
            ->get();
        if (!$posts) {
            return response()->json(['success' => false, 'message' => 'No post found for this company'], 404);
        }
        return response()->json(['success' => true, 'data' => $posts]);
    }

    //update status
    public function update_status(Request $request, $id)
    {
        $post = Post::find($id);
        if (!$post) {
            return response()->json(['success' => false, 'message' => 'Post not found'], 404);
        }
        if ($request->user()->role_id !== 3) {
            return response()->json(['success' => false, 'message' => 'You are not the company owner'], 401);
        }

        $status = $request->input('status');
        $notification = null;

        if ($status == 'buy') {
            $notification = Notification::create([
                'type' => 'reply',
                'post_id' => $post->id,
                'message' => "Your scrap has been bought.",
                'status' => 0,
            ]);
        } else if ($status == 'cancel') {
            $notification = Notification::create([
                'type' => 'reply',
                'post_id' => $post->id,
                'message' => "Your scrap has been canceled.",
                'status' => 0,
            ]);
        } else if ($status == 'buy' && $post->company_id !== null) {
            $notification = Notification::create([
                'type' => 'reply',
                'post_id' => $post->id,
                'message' => "Your scrap has been bought.",
                'user_id' => $request->user()->id,
                'status' => 0,
            ]);
        }

        if ($notification) {
            // Broadcast the event
            broadcast(new NotificationCreated($notification))->toOthers();
        }

        $post->status = $status;
        $post->save();

        return response()->json(['success' => true, 'message' => 'Status updated successfully']);
    }

//================history====================

// get all post that buy from each company
    public function historyPost(Request $request)
    {
        $posts = Post::where('status', 'buy')
            ->where('company_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();
            // check if company no post
        if ($posts->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot found post for this company'
            ], 404);
        }
        // return if have post on company
        return response()->json([
            'success' => true,

            'data' => PostResource::collection($posts)
        ]);
    }
}
