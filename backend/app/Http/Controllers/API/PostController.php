<?php

namespace App\Http\Controllers\API;

use App\Events\MessageSent;
use App\Events\NotificationCreated;
use App\Events\NotificationSent;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Resources\ShowPostCommentResource;
use App\Models\Chat;
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
        // dd($request->all());
        $request->validate([
            'company_id' => 'nullable|integer',
            'items' => 'nullable|string',
            'title' => 'nullable|string',
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
            broadcast(new NotificationSent($notification))->toOthers();        }

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

        if ($request->items != null) {
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
        }
        // Attach items to the post


        return response()->json(['message' => 'Post created successfully', 'post' => $post], 201);
    }



    //edit post
    public function edit(Request $request, $id)
    {
        // Get the post
        $post = Post::findOrFail($id);

        // Check if the current user is the post owner
        if ($post->user_id != $request->user()->id) {
            return response()->json(['error' => 'You are not authorized to update this post'], 403);
        }

        if ($request->company_id != null) {
            // Update the post
            $post->update([
                'title' => $request->input('title', $post->title),
                'status' => $request->input('status', $post->status),
            ]);
        }else{
            $post->update([
                'title' => $request->input('title', $post->title),
                'company_id' => $request->input('company_id', $post->company_id),
                'status' => $request->input('status', $post->status),
            ]);
        }



        // Handle item updates
        if ($request->input('items')) {
            // Detach old items
            $post->items()->delete(); // This deletes the records in the pivot table

            $items = explode(',', $request->input('items'));
            foreach ($items as $itemId) {
                // Check if the item already exists
                $existingItem = Item::find($itemId);
                if ($existingItem) {
                    // Associate the existing item with the post
                    Post_Item::create([
                        'post_id' => $post->id,
                        'item_id' => $existingItem->id,
                    ]);
                } else {
                    // Create a new item
                    $newItem = Item::create([
                        'name' => $request->input('item_name'),
                    ]);
                    Post_Item::create([
                        'post_id' => $post->id,
                        'item_id' => $newItem->id,
                    ]);
                }
            }
        }

        return response()->json(['message' => 'Post updated successfully', 'post' => $post], 200);
    }

    //add new image to post
    public function add_image_post(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        if ($request->hasFile('image')) {

            // Validate the image
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            // Upload the new image
            $newImage = $request->file('image');
            $name = uniqid() . '.' . $newImage->getClientOriginalExtension();
            $destinationPath = public_path('uploads');
            $newImage->move($destinationPath, $name);

            // Create the new image record in the database
            $newImageRecord = Image::create(['image' => $name]);

            // Create the post-image relationship
            Post_Image::create([
                'post_id' => $post->id,
                'image_id' => $newImageRecord->id,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Image uploaded and associated with the post successfully.',
                'data' => $newImageRecord
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'No image uploaded.'
        ], 400);
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
            $chat = Chat::create([
                'user_id' => $post->company_id ? $post->company_id : $request->user()->id,
                'reciever_id' => $post->user_id,
                'message' => "Hello, I want to buy your scrap! That you posted for sale on " . $post->created_at->format('Y-m-d H:i:s')
            ]);
            
        if($chat){
            broadcast(new MessageSent($chat))->toOthers();
        }
                     
        } else if ($status == 'cancel') {
            $notification = Notification::create([
                'type' => 'reply',
                'post_id' => $post->id,
                'message' => "Your scrap has been canceled.",
                'status' => 0,
            ]);
        } ;

        if ($notification) {
            // Broadcast the event
            broadcast(new NotificationCreated($notification))->toOthers();
        }
       
        if ($post->company_id == null) {
            $post->company_id = $request->user()->id;
            
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
