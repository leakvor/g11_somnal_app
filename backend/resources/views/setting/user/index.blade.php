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
                        class="text-red-500">{{$users->count() }}</span></p>
                <div id="search-container" class=" flex justify-end pr-5">
                    <div class="relative pr-4 lg:mx-0">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                            <svg class="h-5 w-5 text-gray-500" viewBox="0 0 24 24" fill="none">
                                <path
                                    d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                </path>
                            </svg>
                        </span>

                        <input id="searchInput"
                            class="form-input w-full md:w-64 rounded-md pl-10 pr-4 focus:border-indigo-600" type="text"
                            placeholder="Search user..." onkeyup="searchUsers(this.value)">

                    </div>

                    @can('User create')
                        <a href="{{ route('admin.users.create') }}"
                            class=" flex items-center justify-center bg-green-700 text-white font-bold px-3 py-1 rounded focus:outline-none shadow hover:bg-green-600 transition-colors">
                            <i class="material-icons text-white mr-1 icon-xs">person_add</i>
                            <span>User</span>
                        </a>
                    @endcan
                </div>

                <div class="card-container flex gap-4 flex-wrap py-6 p-2">

                    @foreach($users as $user)
                        <div class="user-card px-6 py-6">
                            <div class="card-body flex items-center mb-3">
                                <div class="profile-container mr-3">
                                    <img src="{{ $user->profile ? asset('images/' . $user->profile) : asset('images/default-profile.png') }}"
                                        alt="Profile Image" class="w-24 h-24 rounded-full">
                                </div>
                                <div class="user-info flex-grow ">
                                    <h3 class="name font-bold break-all mb-2">{{ $user->name }}</h3>
                                    @foreach($user->roles as $role)
                                        <span
                                            class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-white bg-gray-500 rounded-full">{{ $role->name }}</span>
                                    @endforeach
                                    <p class="text-xs text-gray-600 flex items-center mb-1 mt-4"><i
                                            class="material-icons text-blue-500 icon-xs">phone</i>{{ $user->phone }}</p>
                                    <p class="text-xs text-gray-600 flex items-center mb-1 break-all "><i
                                            class="material-icons text-blue-500 icon-xs">email</i>{{ $user->email }}</p>
                                    <p class="text-xs text-gray-600 flex items-center mb-1"><i
                                            class="material-icons text-blue-500 icon-xs">location_on</i>{{ $user->location}}
                                        Phnom Penh</p>
                                    <p class="text-xs text-gray-600 flex items-center mb-1"><i
                                            class="material-icons text-blue-500 icon-xs">event</i>{{ $user->created_at }}
                                    </p>
                                </div>
                            </div>
                            <div class="group-button flex justify-end">
                                @can('User edit')
                                    <a href="{{ route('admin.users.edit', $user->id) }}"
                                        class="btn btn-success flex items-center justify-center bg-green-700 text-white rounded-lg px-3 py-1 text-xs">
                                        <i class="material-icons mr-1 icon-xs">edit</i>
                                        <span>Edit</span>
                                    </a>
                                @endcan
                                @can('User delete')
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit"
                                            onclick="return confirm('Are you sure you want to delete this user?')"
                                            class="btn btn-danger flex items-center justify-center bg-red-500 text-white rounded-lg px-3 py-1 ml-2 text-xs">
                                            <i class="material-icons mr-1 icon-xs">delete</i>
                                            <span>Delete</span>
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        </div>
                    @endforeach
                </div>
                <div id="noUsersFound" class="hidden absolute inset-0 flex items-center justify-center">
                    <p class="text-gray-600" >No users match your search.</p>
                </div>
            </div>


        </main>
    </div>
    <style>
        .user-card {
            width: 300px;
            border: none;
            border-radius: 7px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .user-card:hover {
            transform: translateY(-px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
        }

        .user-info {
            width: 50%;
        }

        .name,
        .gender {
            line-height: 15px;
        }

        .icon-xs {
            font-size: 16px;
        }

        @media (max-width: 885px) {
            .user-card {
                width: 350px;
            }

            .user-info p {
                font-size: 0.8rem;
            }
        }

        @media (max-width: 768px) {
            #searchInput {
                width: 100%;
            }
        }

        @media (max-width: 428px) {
            #search-container{
                padding-left: 3%;
                justify-content: space-between;
            }
            #searchInput {
                width: 262px;
            }

            .user-card {
                width: 100%;
            }

        }

        @media (max-width: 390px) {
            #search-container{
                padding-left: 3%;
                padding-right: 3%;
            }
            .user-info p {
                font-size: 0.7rem;
                line-height: 1;
            }
            #searchInput {
                width: 100%;
            }
        }

        @media (max-width: 322px) {
    
            #searchInput {
                width: 100%;
                margin-right: 100px;
            }
            .user-info p {
                font-size: 0.6rem;
            }
        }
    </style>
    <script>
        function confirmDelete(userId) {
            if (confirm("Are you sure you want to delete this user?")) {
                window.location.href = "{{ route('admin.users.destroy', ':userId') }}".replace(':userId', userId);
            }
        }

        // search----------------------------------------------------------
        function searchUsers(searchTerm) {
            let cards = document.querySelectorAll('.user-card');
            searchTerm = searchTerm.toLowerCase();
            let foundUsers = false;

            cards.forEach(card => {
                let name = card.querySelector('.name').textContent.toLowerCase();
                if (name.includes(searchTerm)) {
                    card.style.display = 'block';
                    foundUsers = true;
                } else {
                    card.style.display = 'none';
                }
            });

            document.getElementById('noUsersFound').classList.toggle('hidden', foundUsers);
        }

        // alert after created-----------------------------------------------------------------
        document.addEventListener('DOMContentLoaded', function () {
            var flashMessage = document.getElementById('flash-message');
            if (flashMessage) {
                flashMessage.classList.add('opacity-100', 'translate-y-2');
                setTimeout(function () {
                    flashMessage.classList.remove('opacity-100', 'translate-y-2');
                }, 2000);
            }
        });

    </script>
</x-app-layout>