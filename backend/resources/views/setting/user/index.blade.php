<x-app-layout>
    <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="container mx-auto px-4 py-2">

                @if(session('alert'))
                    <div id="flash-message" class="fixed w-9/12 mb-4 mr-4 px-4 py-4 rounded shadow-md
                                @if(session('alert')['type'] == 'success') bg-green-500 text-white
                                @elseif(session('alert')['type'] == 'error') bg-red-500 text-white
                                @endif
                                opacity-0 transform transition-all duration-500">
                        <div class="flex items-center">
                            <i class="material-icons text-white mr-2 icon-lg">check_circle</i>
                            <p>{{ session('alert')['message'] }}</p>
                        </div>
                    </div>
                @endif

                <h3 class="text-gray-700 text-3xl font-medium">Users</h3>
                <p class="text-base text-gray-600 mb-2">Number of users: <span
                        class="text-red-500">{{auth()->user()->count() }}</span></p>
                <div id="search-container" class="flex justify-end pr-5">
                    <div class="relative pr-4 lg:mx-0">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                            <svg class="h-5 w-5 text-gray-500" viewBox="0 0 24 24" fill="none">
                                <path
                                    d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </svg>
                        </span>
                        <input id="searchInput"
                            class="form-input w-full md:w-64 rounded-md pl-10 pr-4 focus:border-indigo-600" type="text"
                            placeholder="Search user..." onkeyup="searchUsers(this.value)">
                    </div>

                    @can('User create')
                        <a href="{{ route('admin.users.create') }}"
                            class="flex items-center justify-center bg-green-700 text-white font-bold px-3 py-1 rounded focus:outline-none shadow hover:bg-green-600 transition-colors">
                            <i class="material-icons text-white mr-1 icon-xs">person_add</i>
                            <span>User</span>
                        </a>
                    @endcan
                </div>

                <div class="bg-white shadow-md rounded my-6">
                    <table class="text-left w-full border-collapse">
                        <thead>
                            <tr>
                                <th
                                    class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light">
                                    User Name</th>
                                <th
                                    class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light">
                                    Role</th>
                                <th
                                    class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light text-right">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody id="userTableBody">
                            @can('User access')
                                @foreach($users as $user)
                                    <tr class="hover:bg-grey-lighter user-row">
                                        <td class="py-4 px-6 border-b border-grey-light name">
                                            <span>{{ $user->name }}</span>
                                        </td>
                                        <td class="py-4 px-6 border-b border-grey-light">
                                            @foreach($user->roles as $role)
                                                <span
                                                    class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-white bg-gray-500 rounded-full">{{ $role->name }}</span>
                                            @endforeach
                                        </td>
                                        <td class="py-4 px-6 border-b border-grey-light text-right">
                                            @can('User edit')
                                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                                    class="text-grey-lighter font-bold py-1 px-5 mt-1 rounded text-xs bg-green-500 hover:bg-green-700 text-white">Edit</a>
                                            @endcan

                                            @can('User delete')
                                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                                    class="inline" onsubmit="return confirmDelete()">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit"
                                                        class="btn text-grey-lighter font-bold py-1 px-3 mt-1 rounded text-xs bg-red-600 hover:bg-red-700 text-white">Delete</button>
                                                </form>
                                            @endcan

                                            <button
                                                onclick="openUserModal('{{ $user->name }}', '{{ $user->email }}', '{{ $user->roles->pluck('name')->implode(',') }}', '{{ $user->phone }}', '{{ $user->profile }}', '{{ $user->created_at->format('M d, Y') }}')"
                                                class="text-grey-lighter font-bold py-1 px-3 mt-1 rounded text-xs bg-blue-500 hover:bg-blue-700 text-white">Details</button>
                                        </td>

                                        </td>
                                    </tr>
                                @endforeach
                            @endcan
                        </tbody>
                    </table>
                    <div class="text-right p-4 " id="pagination">
                        {{ $users->links() }}
                    </div>
                    <div id="noUsersFound" class="hidden p-10 inset-0 flex items-center justify-center">
                        <p class="text-gray-600">No users match your search.</p>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal -->
    <div id="userModal"
        class="fixed inset-0 z-50 overflow-auto bg-gray-900 bg-opacity-75 flex items-center justify-center hidden">
        <div class="bg-white dark:bg-gray-800 w-96 max-w-md mx-auto p-8 rounded-lg shadow-xl relative">
            <button class="absolute top-4 right-4 text-gray-600 hover:text-gray-800" onclick="closeUserModal()">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
            <div id="userModalContent" class="text-gray-700 dark:text-gray-300">
                <!-- User details will be dynamically inserted here -->
            </div>
        </div>
    </div>


    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this user?");
        }

        function openUserModal(name, email, roles, phone, profile, createdAt) {
            const modal = document.getElementById('userModal');
            const modalContent = document.getElementById('userModalContent');
            const profileImage = profile ? `{{ asset('/${profile}') }}` : `{{ asset('images/default-profile.png') }}`;

            modalContent.innerHTML = `
            <div class="flex flex-col items-center">
                <div class="relative w-32 h-32">
                    <img class="w-full h-full rounded-full shadow-lg object-cover" src="${profileImage}" alt="Profile Image">
                </div>
                <h2 class="mt-4 text-2xl font-bold text-gray-800">${name}</h2>
                <p class="text-gray-600 ">${roles}</p>
                <div class="w-full">
                    <div class="flex">
                        <i class="material-icons text-gray-600 mr-2">phone</i>
                        <a href="tel:${phone}" class="text-gray-600">${phone}</a>
                    </div>
                    <div class="flex ">
                       <i class="material-icons text-gray-600 mr-2">email</i>
                        <a href="mailto:${email}" class="text-gray-600">${email}</a>
                    </div>
                    <div class="flex">
                      <i class="material-icons text-gray-600 mr-2">calendar_month</i>
                        <span class="text-gray-600">${createdAt}</span>
                    </div>
                </div>
            </div>
        `;

            modal.classList.remove('hidden');
        }

        function closeUserModal() {
            const modal = document.getElementById('userModal');
            modal.classList.add('hidden');
        }

        function searchUsers(searchTerm) {
            const rows = document.querySelectorAll('.user-row');
            const noUsersFound = document.getElementById('noUsersFound');
            const pagination = document.getElementById('pagination');
            let foundUsers = false;
            searchTerm = searchTerm.toLowerCase();

            rows.forEach(row => {
                const name = row.querySelector('.name').textContent.toLowerCase();
                if (name.includes(searchTerm)) {
                    row.style.display = '';
                    foundUsers = true;
                } else {
                    row.style.display = 'none';
                }
            });

            noUsersFound.classList.toggle('hidden', foundUsers);
            pagination.classList.toggle('hidden', !foundUsers);
        }

        document.addEventListener('DOMContentLoaded', function () {
            const flashMessage = document.getElementById('flash-message');
            if (flashMessage) {
                flashMessage.classList.add('opacity-100', 'translate-y-2');
                setTimeout(function () {
                    flashMessage.classList.remove('opacity-100', 'translate-y-2');
                }, 2000);
            }

            // Close modal when clicking outside of it
            window.addEventListener('click', function (event) {
                const modal = document.getElementById('userModal');
                const modalContent = document.querySelector('#userModal .bg-white');
                if (event.target === modal && !modalContent.contains(event.target)) {
                    closeUserModal();
                }
            });
        });
    </script>

</x-app-layout>
