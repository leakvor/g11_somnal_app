<x-app-layout>
    <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="container mx-auto px-6 py-1 pb-16">
                <div class="bg-white shadow-md rounded my-6 p-5">
                    <form method="POST" action="{{ route('admin.optionPaid.update', $optionPaid->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="flex flex-col space-y-2">
                            <label for="option_paid" class="text-gray-700 select-none font-medium">Option Paid</label>
                            <input id="option_paid" type="text" name="option_paid" value="{{ old('option_paid', $optionPaid->option_paid) }}"
                                class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                            />
                        </div>
                        <div class="flex flex-col space-y-2">
                            <label for="amount" class="text-gray-700 select-none font-medium">Amount</label>
                            <input id="amount" type="number" name="amount" value="{{ old('amount', $optionPaid->amount) }}"
                                class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                            />
                        </div>
                        <div class="flex flex-col space-y-2">
                            <label for="description" class="text-gray-700 select-none font-medium">Description</label>
                            <input id="description" type="text" name="description" value="{{ old('description', $optionPaid->description) }}"
                                class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                            />
                        </div>
                        <div class="flex flex-col space-y-2">
                            <label for="type" class="text-gray-700 select-none font-medium">Type</label>
                            <input id="type" type="text" name="type" value="{{ old('type', $optionPaid->type) }}"
                                class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                            />
                        </div>
                        <div class="text-center mt-16 mb-16">
                            <button type="submit" class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>
