
<x-app-layout>
  <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
    <div class="container mx-auto px-6 py-2">

      <div class="bg-white shadow-md rounded my-6">
        <table id="category" class="dataTable table table-striped table-bordered" style="width:100%">
          <thead>
            <tr>
            <th class="w-1/4 py-4 px-6 text-left text-gray-600 font-bold uppercase">Id</th>
                        <th class="w-1/4 py-4 px-6 text-left text-gray-600 font-bold uppercase">Name</th>
                        <th class="w-1/4 py-4 px-6 text-left text-gray-600 font-bold uppercase">Price</th>
                        <th class="w-1/4 py-4 px-6 text-left text-gray-600 font-bold uppercase">Date</th>
            </tr>
          </thead>
          <tbody>
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

        @can('history access')
          <div class="text-right p-4 py-10">
          {{ $histories->links() }}
          </div>
        @endcan
      </div>
    </div>
  </main>


  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.tailwind.min.css">
  <script src="https://cdn.datatables.net/2.0.8/js/dataTables.dataTables.min.js"></script>
  <script>
<script>
  $(document).ready(function() {
    $('#category').DataTable({
     "pagingType": "full_numbers",
      "lengthMenu": [
        [10, 25, 50, -1],
        [10, 25, 50, "All"]
      ],
      responsive: true,
      language: {
        search: "_INPUT_",
       searchPlaceholder: "Search records",
      }
   });
  });
function confirmDelete(button) {
      if (confirm("Are you sure you want to delete this item?")) {
        button.closest('form').submit();
      }
    }

</script>

</x-app-layout>

<style>
  .dataTables_wrapper .dataTables_length,
  .dataTables_wrapper .dataTables_filter,
  .dataTables_wrapper .dataTables_info,
  .dataTables_wrapper .dataTables_processing,
  .dataTables_wrapper .dataTables_paginate {
    float: left;
  }

  .dataTables_wrapper .dataTables_paginate {
    float: right;
  }

  .dataTables_wrapper .dataTables_paginate .paginate_button {
    padding: 0;
    margin: 0;
    border: 0;
    background: none;
    font-size: 1.25rem;
    cursor: pointer;
  }

  .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    background: #f1f1f1;
  }

  .dataTables_wrapper .dataTables_paginate .paginate_button.current,
  .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
    background: #ddd;
  }

  .dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
  .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover {
    background: none;
    cursor: not-allowed;
  }

  .dataTables_wrapper .dataTables_length label,
  .dataTables_wrapper .dataTables_filter label,
  .dataTables_wrapper .dataTables_info label {
    margin-right: 10px;
  }
</style>