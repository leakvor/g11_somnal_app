<!-- resources/views/dashboard.blade.php -->

<x-app-layout>
    <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="container mx-auto px-6 py-8">
                <h3 class="text-gray-700 text-3xl font-medium">Admin Dashboard</h3>
            </div>
        </main>
        <div class="container mx-auto mt-5 px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mt-5">
                {{-- <a href="{{ route('admin.revenues.index') }}" class="bg-white rounded-lg shadow-md p-4 text-center hover:-translate-y-3px hover:shadow-xl duration-300">
                    <div class="card-body">
                        <img src="{{ asset('images/icons/revenue.png') }}" alt="Revenue" class="w-12 mx-auto mt-1">
                        <p class="mt-3 text-xs">Revenue</p>
                        <h5 class="text-blue-500 break-all font-bold">{{ $revenue }}</h5>
                    </div>
                </a> --}}

                <a href="{{ route('admin.users.index') }}" class="bg-white rounded-lg shadow-md p-4 text-center hover:-translate-y-3px hover:shadow-xl duration-300">
                    <div class="card-body">
                        <img src="{{ asset('images/icons/users.png') }}" alt="user" class="w-12 mx-auto mt-5">
                        <p class="mt-3 text-xs">user</p>
                        <h5 class="text-blue-500 font-bold">{{ $userCount }}</h5>
                    </div>
                </a>

                <a href="#" class="bg-white rounded-lg shadow-md p-4 text-center hover:-translate-y-3px hover:shadow-xl duration-300">
                    <div class="card-body">
                        <img src="{{ asset('images/icons/companies.png') }}" alt="company" class="w-12 mx-auto mt-4">
                        <p class="mt-3 text-xs">company</p>
                        <h5 class="text-blue-500 font-bold">{{ $companyCount }}</h5>
                    </div>
                </a>

                <a href="#" class="bg-white rounded-lg shadow-md p-4 text-center hover:-translate-y-3px hover:shadow-xl duration-300">
                    <div class="card-body">
                        <img src="{{ asset('images/icons/scrap.png') }}" alt="scrap" class="w-12 mx-auto mt-2">
                        <p class="mt-3 text-xs">Scrap</p>
                        <h5 class="text-blue-500 font-bold">{{ $scrapCount }}</h5>
                    </div>
                </a>
            </div>
        </div>
        <div class="bg-white mt-5 p-5">
            <canvas id="myChart" style="width:100%; min-height: 400px; height:400px;"></canvas>
        </div>
        <script>
            const ctx = document.getElementById('myChart').getContext('2d');

            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: 'Revenue monthly',
                        data: [65, 59, 80, 81, 56, 55, 40, 55, 30, 80, 60, 90],
                        backgroundColor: [
                            '#14213d',
                            '#F94144', 
                            '#F3722C', 
                            '#F8961E', 
                            '#F9C74F',
                            '#90BE6D', 
                            '#43AA8B',
                            '#577590', 
                            '#277DA1', 
                            '#4895EF',
                            '#9A7BFF',
                            '#F27B35' 
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            align: 'start', 
                            labels: {
                                font: {
                                    size: 14 ,
                                    weight: 'normal'
                                }
                            }
                        },
                        title: {
                            display: true,
                            text: 'January 1, 2022 - December 31, 2022',
                            align: 'start', 
                            font: {
                                size: 17,
                                weight: 'normal'
                            }
                        },
                    },
                }
            });
        </script>
    </div>
</x-app-layout>