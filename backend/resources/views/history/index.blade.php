
<x-app-layout>
    <div class="shadow-lg rounded-lg overflow-hidden mx-4 md:mx-10 mt-10">
        <div class="overflow-x-auto">
            <table class="w-full table-fixed">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="w-1/4 py-4 px-6 text-left text-gray-600 font-bold uppercase">Id</th>
                        <th class="w-1/4 py-4 px-6 text-left text-gray-600 font-bold uppercase">Name</th>
                        <th class="w-1/4 py-4 px-6 text-left text-gray-600 font-bold uppercase">Price</th>
                        <th class="w-1/4 py-4 px-6 text-left text-gray-600 font-bold uppercase">Date</th>
                    </tr>
                </thead>
                <tbody class="bg-white max-h-64 overflow-y-auto">
                    @can('history access')
                    @foreach ($histories as $history)
                    <tr>
                        <td class="py-4 px-6 border-b border-gray-200">{{ $loop->index + 1 }}</td>
                        <td class="py-4 px-6 border-b border-gray-200 truncate">
                            @php
                                $itemFound = $items->firstWhere('id', $history->adjay_id);
                            @endphp
                            @if ($itemFound)
                                {{ $itemFound->name }}
                            @else
                                Item not found
                            @endif
                        </td>

                        <td class="py-4 px-6 border-b border-gray-200 truncate">{{$history->old_price}} ៛</td>
                        <td class="py-4 px-6 border-b border-gray-200 truncate">{{$history->date}} </td>

                       
                    </tr>
                    @endforeach
                    @endcan
                </tbody>
            </table>
        </div>
    </div>


    
  </x-app-layout>

  <script>
function confirmDelete(button) {
    if (confirm("Are you sure you want to delete this category?")) {
        button.closest('form').submit();
    }
}
</script>
