<x-app-layout>
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200 mx-4">
        <div class="container mx-auto mt-10">
            <div class="flex justify-between items-center mb-5">
                <h1 class="text-2xl font-bold">Companies: ({{ $companies->total() }})</h1>
                
                <!-- Search Bar -->
                <div class="relative w-1/2 ml-4">
                    <input type="text" id="search" name="search" placeholder="Search by user or category..." class="w-full pl-4 pr-4 py-3 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300">
                    <div id="suggestion-box" class="absolute w-full bg-white border border-gray-300 rounded-lg mt-1 hidden"></div>
                </div>

                <a href="{{ route('admin.companies.create') }}" class="ml-4 bg-green-500 text-white px-4 py-2 rounded">Add Company</a>
            </div>

            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="w-1/6 py-3 px-4 text-left">Name</th>
                            <th class="w-1/6 py-3 px-4 text-left">Phone</th>
                            <th class="w-1/6 py-3 px-4 text-left">Email</th>
                            <th class="w-1/6 py-3 px-4 text-left">Categories</th>
                            <th class="w-1/6 py-3 px-4 text-left">User</th>
                            <th class="w-1/6 py-3 px-4 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="company-list">
                        @foreach ($companies as $company)
                        <tr class="border-b">
                            <td class="py-3 px-4">{{ $company->name }}</td>
                            <td class="py-3 px-4">{{ $company->phone }}</td>
                            <td class="py-3 px-4">{{ $company->email }}</td>
                            <td class="py-3 px-4">{{ $company->category->name }}</td>
                            <td class="py-3 px-4">{{ $company->user->name }}</td>
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

            <!-- Pagination Links -->
            <div class="mt-5">
                {{ $companies->links() }}
            </div>
        </div>
    </main>
</x-app-layout>

<script>
document.getElementById('search').addEventListener('input', function() {
    let filter = this.value.toLowerCase();
    let rows = document.querySelectorAll('#company-list tr');

    rows.forEach(row => {
        let name = row.cells[0].innerText.toLowerCase();
        let phone = row.cells[1].innerText.toLowerCase();
        let email = row.cells[2].innerText.toLowerCase();
        let category = row.cells[3].innerText.toLowerCase();
        let user = row.cells[4].innerText.toLowerCase();
        
        if (name.includes(filter) || phone.includes(filter) || email.includes(filter) || category.includes(filter) || user.includes(filter)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });

    // Show all rows if the input is cleared
    if (filter === '') {
        rows.forEach(row => row.style.display = '');
    }
});
</script>