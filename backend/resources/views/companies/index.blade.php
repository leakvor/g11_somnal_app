{{-- resources/views/companies/index.blade.php --}}

<x-app-layout>
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200 mx-4">
        <div class="container mx-auto mt-10">
            <div class="flex justify-between items-center mb-5">
                <h1 class="text-2xl font-bold">Companies: ({{ $companies->count() }})</h1>
                <a href="{{ route('admin.companies.create') }}" class="bg-green-500 text-white px-4 py-2 rounded">Add Company</a>
            </div>

            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="w-1/6 py-3 px-4 text-left">Name</th>
                            <th class="w-1/6 py-3 px-4 text-left">Phone</th>
                            <th class="w-1/6 py-3 px-4 text-left">Email</th>
                            <th class="w-1/6 py-3 px-4 text-left">Address</th>
                            <th class="w-1/6 py-3 px-4 text-left">User ID</th>
                            <th class="w-1/6 py-3 px-4 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($companies as $company)
                        <tr class="border-b">
                            <td class="py-3 px-4">{{ $company->name }}</td>
                            <td class="py-3 px-4">{{ $company->phone }}</td>
                            <td class="py-3 px-4">{{ $company->email }}</td>
                            <td class="py-3 px-4">{{ $company->address }}</td>
                            <td class="py-3 px-4">{{ $company->user_id }}</td>
                            <td class="py-3 px-4">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.companies.show', $company->id) }}" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded transition duration-300">View</a>
                                    <a href="{{ route('admin.companies.edit', $company->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded transition duration-300">Edit</a>
                                    <form action="{{ route('admin.companies.destroy', $company->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded transition duration-300" onclick="return confirm('Are you sure you want to delete this company?')">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</x-app-layout>