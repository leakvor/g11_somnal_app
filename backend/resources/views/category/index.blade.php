
    <x-app-layout>
        <div class="shadow-lg rounded-lg overflow-hidden mx-4 md:mx-10 mt-10">
            <div class="text-right">
                @can('category create')
                  <a href="{{route('admin.categories.create')}}" class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors ">New post</a>
                @endcan
              </div>
        
            <div class="overflow-x-auto">
                <table class="w-full table-fixed">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="w-1/4 py-4 px-6 text-left text-gray-600 font-bold uppercase">Id</th>
                            <th class="w-1/4 py-4 px-6 text-left text-gray-600 font-bold uppercase">Name</th>
                            <th class="w-1/4 py-4 px-6 text-left text-gray-600 font-bold uppercase">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white max-h-64 overflow-y-auto">
                        @can('category access')
                        @foreach ($categories as $category)
                        <tr>
                            <td class="py-4 px-6 border-b border-gray-200">{{ $loop->index + 1 }}</td>
                            <td class="py-4 px-6 border-b border-gray-200 truncate">{{$category->name}}</td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                @can('category edit')
                                <a href="{{route('admin.categories.edit',$category->id)}}"class="px-4 py-2 font-medium text-white bg-blue-600 rounded-md hover:bg-blue-500 focus:outline-none focus:shadow-outline-blue active:bg-blue-600 transition duration-150 ease-in-out">Edit</a>
                                 @endcan
                            
                                @can('category delete')
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('delete')
                                    <button  onclick="confirmDelete(this)" class="ml-2 px-4 py-2 font-medium text-white bg-red-600 rounded-md hover:bg-red-500 focus:outline-none focus:shadow-outline-red active:bg-red-600 transition duration-150 ease-in-out">Delete</button>
                                </form>
                                @endcan
                               
                            </td>
                        </tr>
                        @endforeach
                        @endcan
                    </tbody>
                </table>
            </div>
        </div>


        
      </x-app-layout>

      <script>
    function confirmDelete(button) {
        if (confirm("Are you sure you want to delete this category?")) {
            button.closest('form').submit();
        }
    }
</script>
