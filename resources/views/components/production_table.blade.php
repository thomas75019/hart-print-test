<h2 class="text-2xl font-bold mb-4 mt-4 text-center">Production Schedule</h2>
<div class="container ml-4 py-4">
    <div class="mb-4">
        <a href="{{ route('create') }}" class="inline-block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Create New Order</a>
    </div>
</div>
<div class="overflow-x-auto">
    <table class="table-auto w-full border-collapse">
        <thead>
            <tr>
                <th class="px-4 py-2 bg-gray-200 text-gray-700 border">Order ID</th>
                <th class="px-4 py-2 bg-gray-200 text-gray-700 border">Start Time</th>
                <th class="px-4 py-2 bg-gray-200 text-gray-700 border">End Time</th>
                <th class="px-4 py-2 bg-gray-200 text-gray-700 border">Need By Date</th>
                <th class="px-4 py-2 bg-gray-200 text-gray-700 border">Prevision</th>
                <th class="px-4 py-2 bg-gray-200 text-gray-700 border">
                    Approximate Hours of Production
                </th>
                <th class="px-4 py-2 bg-gray-200 text-gray-700 border">Type</th>
            </tr>
        </thead>
        <tbody>
            @foreach($schedule as $item)
                <tr>
                    <td class="px-4 py-2 border text-center">{{ $item['order_id'] }}</td>
                    <td class="px-4 py-2 border text-center">{{ $item['start_time'] }}</td>
                    <td class="px-4 py-2 border text-center">{{ $item['end_time'] }}</td>
                    <td class="px-4 py-2 border text-center">{{ $item['need_by_date'] }}</td>
                    <td class="px-4 py-2 border text-center">{{ $item['prevision'] }}</td>
                    <td class="px-4 py-2 border text-center">{{ $item['hours'] }}</td>
                    <td class="px-4 py-2 border text-center">{{ config("product-types." . $item['type'] . ".name") }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>