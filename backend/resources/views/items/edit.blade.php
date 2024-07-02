<x-app-layout>
    <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="container mx-auto px-6 py-1 pb-16">
                <h1>Edit Item</h1>
                <div class="bg-white shadow-md rounded my-6 p-5">
                    <form method="POST" action="{{ route('admin.items.update', $item->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT') <!-- This hidden input is used to spoof the PUT method -->

                        <div class="flex flex-col space-y-2" style="margin-top:5px">
                            <!-- <label for="name" class="text-gray-700 select-none font-medium">Name Item</label> -->
                            <input id="name" type="text" name="name" value="{{ old('name', $item->name) }}"
                                placeholder="Enter Name"
                                class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                        </div>

                        <div class="flex flex-col space-y-2" style="margin-top:5px">
                            @can('category access')
                                <!-- <label for="category" class="text-gray-700 select-none font-medium">Category</label> -->
                                <select id="category" name="category_id"
                                    class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @if(old('category_id', $item->category_id) == $category->id) selected @endif>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            @endcan
                        </div>

                        <div class="flex flex-col space-y-2" style="margin-top:5px">
                            <!-- <label for="price" class="text-gray-700 select-none font-medium">Price</label> -->
                            <input id="price" type="number" name="price" value="{{ old('price', $item->price) }}"
                                placeholder="Enter Price"
                                class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                        </div>

                        <div class="flex flex-col space-y-2">
                        <img id="image-preview" src="/uploads/{{ $item->image}}" alt="Item Image" class="cursor-pointer" width="100" style="border: 1px solid,margin-top">
                        <input type="file" id="image-input" name="image" style="display: none;">
                        </div>
                
                        <div class="text-center mt-16 mb-16">
                            <button type="submit"
                                class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>

<script>
    document.getElementById('image-preview').addEventListener('click', function() {
        document.getElementById('image-input').click();
    });
</script>
<style>
    #image-input {
        position: absolute;
        top: -1000px;
    }

    #image-preview {
        object-fit: cover;
        width: 100px;
        height: 100px;
        border-radius: 50%;
    }
</style>