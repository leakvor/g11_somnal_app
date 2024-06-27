<x-app-layout>
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
        <div class="container mx-auto px-6 py-8">
            <h3 class="text-3xl font-medium text-gray-700">Revenue Monthly</h3>
            <p class="text-base text-gray-600 mt-2 mb-6">Total: <span
                    class="text-red-600 font-bold">$50,363,350.00</span></p>
            <div class="flex flex-col md:flex-row justify-end mb-6 space-y-4 md:space-y-0 md:space-x-4">
                <select id="monthFilter" class="form-select w-full md:w-1/4 p-2 border rounded bg-white mb-2 md:mb-0"
                    onchange="filterByMonth(this.value)">
                    <option value="all" selected>All Months</option>
                    <option value="January">January</option>
                    <option value="February">February</option>
                    <option value="March">March</option>
                    <option value="April">April</option>
                    <option value="May">May</option>
                    <option value="June">June</option>
                    <option value="July">July</option>
                    <option value="August">August</option>
                    <option value="September">September</option>
                    <option value="October">October</option>
                    <option value="November">November</option>
                    <option value="December">December</option>
                </select>

                <div class="relative  lg:mx-0">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                        <svg class="h-5 w-5 text-gray-500" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            </path>
                        </svg>
                    </span>

                    <input id="searchInput"
                        class="form-input w-full md:w-64 rounded-md pl-10 pr-4 focus:border-indigo-600" type="text"
                        placeholder="Search user..." onkeyup="filterByCompanyName(this.value)">

                </div>
            </div>
            <div class="bg-white shadow-md rounded overflow-x-auto">
                <table id="revenueTable" class="min-w-full bg-white border-collapse table-auto">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="py-2 px-4 border-b text-left whitespace-nowrap">Company</th>
                            <th class="py-2 px-4 border-b text-left whitespace-nowrap">Owner</th>
                            <th class="py-2 px-4 border-b text-left whitespace-nowrap">Date</th>
                            <th class="py-2 px-4 border-b text-left whitespace-nowrap">Fee</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr class="hover:bg-gray-50">
                            <td id="company-name" class="py-3 px-4 border-b whitespace-nowrap">Company Name</td>
                            <td class="py-3 px-4 border-b whitespace-nowrap">Owner Name</td>
                            <td id="date" class="py-3 px-4 border-b whitespace-nowrap">27-June-2024</td>
                            <td class="py-3 px-4 border-b text-red-700 whitespace-nowrap">$503,633.50</td>
                        </tr>

                        <tr class="hover:bg-gray-50">
                            <td id="company-name" class="py-3 px-4 border-b whitespace-nowrap">Adjay PP</td>
                            <td class="py-3 px-4 border-b whitespace-nowrap">Owner Name</td>
                            <td id="date" class="py-3 px-4 border-b whitespace-nowrap">27-June-2024</td>
                            <td class="py-3 px-4 border-b text-red-700 whitespace-nowrap">$503,633.50</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </main>
</x-app-layout>

<script>

    // Function to filter table rows by month
    function filterByMonth(selectedMonth) {
        let tableRows = document.querySelectorAll('#revenueTable tbody tr');
        tableRows.forEach(row => {
            let rowDate = row.querySelector('#date').innerText.trim();
            let rowMonth = rowDate.split('-')[1];

            if (selectedMonth === 'all' || selectedMonth.toLowerCase() === rowMonth.toLowerCase()) {
                row.style.display = 'table-row';
            } else {
                row.style.display = 'none';
            }
        });
    }

    // Function to filter table rows by company name
    function filterByCompanyName(searchValue) {
        let tableRows = document.querySelectorAll('#revenueTable tbody tr');
        tableRows.forEach(row => {
            let companyName = row.querySelector('#company-name').innerText.trim();
            if (companyName.toLowerCase().includes(searchValue.toLowerCase())) {
                row.style.display = 'table-row';
            } else {
                row.style.display = 'none';
            }
        });
    }


</script>