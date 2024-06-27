<x-app-layout>
    <div class="container mx-auto">
        <div class="text-right mt-5">
        @can('item create')
        <a href="{{ route('admin.items.create') }}" class="btn bg-blue-500 text-white font-bold px-5 py-2 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors mt-10">New Item</a>
        </div>
        @endcan
        <div class="flex flex-wrap justify-center mt-6">
            @can('item access')
                @foreach ($items as $item)
                    <div class="card max-w-xs sm:max-w-sm md:max-w-md lg:max-w-lg xl:max-w-xl rounded overflow-hidden shadow-lg m-4">
                        <img class="w-full h-56 object-cover" src="{{ asset('uploads/' . $item->image) }}" alt="Image">
                        <div class="px-6 py-4">
                            <div class="font-bold text-xl mb-2">{{ $item->name }}</div>
                            <p class="text-gray-700 text-base">{{ $item->price }} ៛</p>
                        </div>
                        <div class="px-6 pt-4 pb-2">
                            @can('item edit')
                                <a href="{{ route('admin.items.edit', $item->id) }}" class="btn-edit bg-green-700">Edit</a>
                            @endcan
                            @can('item delete')
                                <form action="{{ route('admin.items.destroy', $item->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('delete')
                                    <button  onclick="confirmDelete(this)" class="ml-2 px-4 py-2 font-medium text-white bg-red-600 rounded-md hover:bg-red-500 focus:outline-none focus:shadow-outline-red active:bg-red-600 transition duration-150 ease-in-out">Delete</button>
                                </form>
                            @endcan
                        </div>
                    </div>
                @endforeach
            @endcan
        </div>
    </div>
</x-app-layout>

<style>
   <style>
    .container{
        margin: 0 15px 30px;
    }
    .card {
        width: calc(30% - 60px); /* 33.33% width for three cards per line with 30px margin on each side */
         /* Top and bottom margin 30px, left and right margin 15px */
        display: inline-block; /* Ensures cards stay in a line */
        vertical-align: top; /* Aligns cards at the top */
        box-sizing: border-box; /* Includes padding and border in the element's total width and height */
    }

    @media (max-width: 1024px) {
        .card {
            width: calc(50% - 30px); /* Two cards per line on tablets with 30px margin on each side */
        }
    }

    @media (max-width: 768px) {
        .card {
            width: calc(100% - 30px); /* One card per line on mobile with 30px margin on each side */
            margin: 0 15px 30px; /* Adjusting margin for mobile */
        }
    }


/* Common styles */
.btn {
    margin-left: auto; /* Aligns New Item button to the right */
    margin-top: 1.5rem; /* Adds some top margin */
}

.btn-edit,
.btn-delete {
    display: inline-block;
    padding: 0.5rem 1rem;
    font-size: 0.875rem; /* Adjust font size */
    font-weight: 600; /* Adjust font weight */
    text-align: center;
    text-decoration: none;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-edit {
    
    color: white; /* White text */
    margin-right: 0.5rem; /* Adds space between Edit and Delete buttons */
}

.btn-delete {
    background-color: #e53e3e; /* Red color */
    color: white; /* White text */
}
.text-right{
    margin-right: 130px;
}

</style>

<script>
    function confirmDelete(button) {
        if (confirm("Are you sure you want to delete this category?")) {
            button.closest('form').submit();
        }
    }
    </script>