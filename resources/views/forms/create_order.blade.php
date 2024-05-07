@extends('layouts.base')

@section('content')
    <h2 class="text-2xl font-bold mb-4 mt-4 text-center">Create Order</h2>
    <div class="mx-auto flex flex-col items-center">
        <div class="mb-4">
            <a href="{{ route('index') }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Back to Production Schedule</a>
        </div>
        <form action="{{ route('store') }}" method="POST" class="max-w-md w-full mx-auto">
            @csrf

            <div class="mb-4">
                <label for="customer_name" class="block text-gray-700 text-sm font-bold mb-2">Customer Name:</label>
                <input type="text" id="customer_name" name="customer_name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('customer_name') }}" required>
                @error('customer_name')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Products:</label>
                <div class="flex flex-col">
                    @foreach($products as $product)
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="product[]" value="{{ $product->id }}" id="product" class="form-checkbox">
                            <span class="ml-2">{{ $product->name . ' - ' . config("product-types.$product->type.name") }}</span>
                        </label>
                    @endforeach
                </div>
                @error('product')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>


            <div id="quantity-fields" class="mb-4">
                {{-- Quantity fields will be dynamically added here using JavaScript --}}
            </div>

            <div class="mb-4">
                <label for="need_by_date" class="block text-gray-700 text-sm font-bold mb-2">Need By Date:</label>
                <input type="date" id="need_by_date" name="need_by_date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('need_by_date') }}" required>
                @error('need_by_date')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Create Order</button>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/selectedProducts.js') }}"></script>
@endsection
