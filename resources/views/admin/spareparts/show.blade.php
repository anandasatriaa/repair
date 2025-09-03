@extends('admin.layouts.app')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="bg-light rounded p-4 mb-4">
        <h6 class="mb-3">Spare Part Detail</h6>
        <p><strong>Item Code:</strong> {{ $sparePart->item_code }}</p>
        <p><strong>Description:</strong> {{ $sparePart->description }}</p>
        <p><strong>Brand:</strong> {{ $sparePart->brand }}</p>
        <a href="{{ route('admin.spare-parts.index') }}" class="btn btn-secondary btn-sm">Back to List</a>
    </div>

    <div class="bg-light rounded p-4 mb-4">
        <h6 class="mb-3">Add New Price</h6>
        <form action="{{ route('admin.spare-parts.prices.store', $sparePart->id) }}" method="POST">
            @csrf
            @include('admin.spareparts._form_price')
            <button type="submit" class="btn btn-primary mt-3">Add Price</button>
        </form>
    </div>

    <div class="bg-light rounded p-4">
        <h6 class="mb-3">Price History</h6>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Price</th>
                        <th>Effective Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sparePart->prices->sortByDesc('effective_date') as $price)
                    <tr>
                        <td>Rp {{ number_format($price->price, 0, ',', '.') }}</td>
                        <td>{{ \Carbon\Carbon::parse($price->effective_date)->format('d M Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="2" class="text-center">No price history.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection