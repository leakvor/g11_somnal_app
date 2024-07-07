{{-- resources/views/companies/show.blade.php --}}

<x-app-layout>
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
        <div class="container mx-auto mt-10 p-6 bg-white shadow-lg rounded-lg border-2" style="border-image: url('{{ asset('images/border.png') }}') 30 round;">
            <h1 class="text-3xl font-bold mb-6 text-center text-blue-800">Company Details</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="col-span-1 md:col-span-2 text-center mb-6">
                    <img src="{{ $company->image ? Storage::url($company->image) : asset('images/default.jpg') }}" alt="Company Image" class="w-48 h-48 object-cover mx-auto rounded-full shadow-md border-2 border-blue-300">
                </div>
                <div class="bg-gray-50 p-4 rounded-lg shadow-inner border border-gray-200">
                    <strong class="text-gray-700">Name:</strong>
                    <p class="text-gray-900">{{ $company->name }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg shadow-inner border border-gray-200">
                    <strong class="text-gray-700">Phone:</strong>
                    <p class="text-gray-900">{{ $company->phone }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg shadow-inner border border-gray-200">
                    <strong class="text-gray-700">Email:</strong>
                    <p class="text-gray-900">{{ $company->email }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg shadow-inner border border-gray-200">
                    <strong class="text-gray-700">Date Work:</strong>
                    <p class="text-gray-900">{{ \Carbon\Carbon::parse($company->date_work)->format('d F Y') }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg shadow-inner border border-gray-200">
                    <strong class="text-gray-700">Company Owner:</strong>
                    <p class="text-gray-900">{{ $company->user->name }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg shadow-inner border border-gray-200">
                    <strong class="text-gray-700">Category:</strong>
                    <p class="text-gray-900">{{ $company->category->name }}</p>
                </div>
            </div>
            <div class="text-center mt-6">
                <a href="{{ route('admin.companies.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg focus:outline-none focus:shadow-outline transition duration-300 ease-in-out">Back</a>
            </div>
        </div>
    </main>
</x-app-layout>