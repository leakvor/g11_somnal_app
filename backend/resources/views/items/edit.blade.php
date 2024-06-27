<x-app-layout>
  <div>
      <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
          <div class="container mx-auto px-6 py-1 pb-16">
              <div class="bg-white shadow-md rounded my-6 p-5">
                  <form method="POST" action="{{ route('admin.items.update', $item->id) }}" enctype="multipart/form-data">
                      @csrf
                      @method('PUT') <!-- This hidden input is used to spoof the PUT method -->
                      
                      <div class="flex flex-col space-y-2">
                          <label for="name" class="text-gray-700 select-none font-medium">Name Item</label>
                          <input id="name" type="text" name="name" value="{{ old('name', $item->name) }}"
                              placeholder="Enter Name" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                          />
                      </div>
                      
                      <div class="flex flex-col space-y-2">
                          @can('category access')
                          <label for="category" class="text-gray-700 select-none font-medium">Category</label>
                          <select id="category" name="category_id" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200">
                              @foreach ($categories as $category)
                              <option value="{{ $category->id }}" @if(old('category_id', $item->category_id) == $category->id) selected @endif>{{ $category->name }}</option>
                              @endforeach
                          </select>
                          @endcan
                      </div>
                      
                      <div class="flex flex-col space-y-2">
                          <label for="price" class="text-gray-700 select-none font-medium">Price</label>
                          <input id="price" type="number" name="price" value="{{ old('price', $item->price) }}"
                              placeholder="Enter Price" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                          />
                      </div>
                      
                      <div class="flex flex-col space-y-2">
                          <label for="image" class="text-gray-700 select-none font-medium">Image</label>
                          <input id="image" type="file" name="image"
                              placeholder="Enter Image" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                          />
                      </div>
                      
                      <div class="text-center mt-16 mb-16">
                          <button type="submit" class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors">Submit</button>
                      </div>
                  </form>
              </div>
          </div>
      </main>
  </div>
</x-app-layout>
