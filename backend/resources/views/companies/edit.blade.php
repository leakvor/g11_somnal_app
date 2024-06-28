{{-- resources/views/companies/edit.blade.php --}}

<x-app-layout>
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
        <div class="container mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
            <h1 class="text-3xl font-bold mb-6 text-center">Edit Company</h1>
            <form method="POST" action="{{ route('admin.companies.update', $company->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-bold mb-2">Name:</label>
                    <input type="text" id="name" name="name" value="{{ $company->name }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <div class="mb-4">
                    <label for="phone" class="block text-gray-700 font-bold mb-2">Phone:</label>
                    <input type="text" id="phone" name="phone" value="{{ $company->phone }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-bold mb-2">Email:</label>
                    <input type="email" id="email" name="email" value="{{ $company->email }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <div class="mb-4">
                    <label for="address" class="block text-gray-700 font-bold mb-2">Address:</label>
                    <input type="text" id="address" name="address" value="{{ $company->address }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <div class="mb-4">
                    <label for="date_work" class="block text-gray-700 font-bold mb-2">Date Work:</label>
                    <input type="date" id="date_work" name="date_work" value="{{ $company->date_work }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <div class="mb-4">
                    <label for="image" class="block text-gray-700 font-bold mb-2">Image:</label>
                    <div class="relative">
                        <input type="file" id="image" name="image" class="absolute inset-0 opacity-0 cursor-pointer w-full h-full">
                        <div class="flex items-center justify-between px-3 py-2 border rounded cursor-pointer bg-gray-100 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <span id="file-name" class="truncate">Choose a file...</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0c0 1.657-1.343 3-3 3H6c-1.657 0-3-1.343-3-3s1.343-3 3-3h12c1.657 0 3 1.343 3 3z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update Company</button>
                </div>
            </form>
        </div>
    </main>
</x-app-layout>

<script>
    document.getElementById('image').addEventListener('change', function() {
        var fileName = this.files[0].name;
        document.getElementById('file-name').textContent = fileName;
    });
</script>