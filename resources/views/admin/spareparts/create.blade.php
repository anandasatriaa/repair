@extends('admin.layouts.app')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="bg-light rounded h-100 p-4">
        <h6 class="mb-4">Add New Spare Part</h6>
        <form action="{{ route('admin.spare-parts.store') }}" method="POST">
            @csrf
            {{-- Form untuk detail spare part --}}
            @include('admin.spareparts._form_detail')

            <hr>
            <h6 class="my-3">Initial Price</h6>
            {{-- Form untuk harga awal --}}
            @include('admin.spareparts._form_price')
            
            <button type="submit" class="btn btn-primary mt-3">Save Spare Part</button>
            <a href="{{ route('admin.spare-parts.index') }}" class="btn btn-secondary mt-3">Cancel</a>
        </form>
    </div>
</div>
@endsection