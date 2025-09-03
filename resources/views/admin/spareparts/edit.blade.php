@extends('admin.layouts.app')

@section('title', 'Edit Spare Part')

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded h-100 p-4">
            <h6 class="mb-4">Edit Spare Part: {{ $sparePart->item_code }}</h6>

            <form action="{{ route('admin.spare-parts.update', $sparePart->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Memanggil komponen form yang sama dengan halaman create --}}
                @include('admin.spareparts._form_detail')

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Update Data</button>
                    <a href="{{ route('admin.spare-parts.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection