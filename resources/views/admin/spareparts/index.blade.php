@extends('admin.layouts.app')

@section('title', 'Price List Spareparts')

@section('content')
    <div class="container-fluid pt-4 px-4">

        {{-- BAGIAN UNTUK SPARE PART AKTIF --}}
        <div class="bg-light rounded h-100 p-4 mb-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h6 class="mb-0">Master Spareparts - Active</h6>
                <a href="{{ route('admin.spare-parts.create') }}" class="btn btn-primary"><i class="fa fa-plus me-2"></i>Add
                    New</a>
            </div>

            @include('admin.partials.alerts')

            <div class="table-responsive">
                {{-- 1. Tambahkan ID pada tabel --}}
                <table class="table table-striped" id="activeSparepartsTable">
                    <thead>
                        <tr>
                            <th scope="col">Item Code</th>
                            <th scope="col">Description</th>
                            <th scope="col">Brand</th>
                            <th scope="col">Current Price</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($activeSpareParts as $part)
                            <tr>
                                <td>{{ $part->item_code }}</td>
                                <td>{{ Str::limit($part->description, 50) }}</td>
                                <td>{{ $part->brand }}</td>
                                <td>
                                    @if ($part->currentPrice)
                                        Rp {{ number_format($part->currentPrice->price, 0, ',', '.') }}
                                    @else
                                        <span class="text-muted">No price set</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.spare-parts.show', $part->id) }}"
                                        class="btn btn-sm btn-info">Prices</a>
                                    <a href="{{ route('admin.spare-parts.edit', $part->id) }}"
                                        class="btn btn-sm btn-secondary">Edit</a>
                                    <button type="button" class="btn btn-sm btn-warning archive-btn" data-bs-toggle="modal"
                                        data-bs-target="#archiveModal" data-id="{{ $part->id }}">
                                        Archive
                                    </button>
                                </td>
                            </tr>
                        @empty
                            {{-- Kosongkan saja karena DataTables akan menampilkan "No data available" --}}
                        @endforelse
                    </tbody>
                </table>
                {{-- 2. Hapus baris pagination Laravel --}}
            </div>
        </div>

        {{-- BAGIAN UNTUK SPARE PART YANG DIARSIPKAN --}}
        <div class="bg-light rounded h-100 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h6 class="mb-0">Archived Spare Parts</h6>
            </div>
            <div class="table-responsive">
                {{-- 1. Tambahkan ID pada tabel --}}
                <table class="table table-striped" id="archivedSparepartsTable">
                    <thead>
                        <tr>
                            <th scope="col">Item Code</th>
                            <th scope="col">Description</th>
                            <th scope="col">Archived At</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($archivedSpareParts as $part)
                            <tr class="table-secondary">
                                <td>{{ $part->item_code }}</td>
                                <td>{{ Str::limit($part->description, 50) }}</td>
                                <td>{{ $part->deleted_at->format('d M Y H:i') }}</td>
                                <td>
                                    <form action="{{ route('admin.spare-parts.restore', $part->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">Restore</button>
                                    </form>
                                    <button type="button" class="btn btn-sm btn-danger permanent-delete-btn"
                                        data-bs-toggle="modal" data-bs-target="#forceDeleteModal"
                                        data-id="{{ $part->id }}">
                                        Delete Permanently
                                    </button>
                                </td>
                            </tr>
                        @empty
                            {{-- Kosongkan saja --}}
                        @endforelse
                    </tbody>
                </table>
                {{-- 2. Hapus baris pagination Laravel --}}
            </div>
        </div>
    </div>

    {{-- Modal untuk Archive --}}
    <div class="modal fade" id="archiveModal" tabindex="-1" aria-labelledby="archiveModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="archiveModalLabel">Confirm Archiving</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to archive this spare part?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="archiveForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-warning">Yes, Archive</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal untuk Hapus Permanen --}}
    <div class="modal fade" id="forceDeleteModal" tabindex="-1" aria-labelledby="forceDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title text-white" id="forceDeleteModalLabel">Confirm Permanent Deletion</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="fs-5"><strong>This is permanent!</strong> Are you sure you want to delete this forever?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="forceDeleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Yes, Delete Permanently</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // 3. Inisialisasi DataTables untuk kedua tabel
            $('#activeSparepartsTable').DataTable();
            $('#archivedSparepartsTable').DataTable();

            // Handler untuk modal Archive (kode ini tetap sama)
            $('#archiveModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var sparePartId = button.data('id');
                var form = $('#archiveForm');
                var actionUrl = '{{ url('admin/spare-parts') }}/' + sparePartId;
                form.attr('action', actionUrl);
            });

            // Handler untuk modal Hapus Permanen (kode ini tetap sama)
            $('#forceDeleteModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var sparePartId = button.data('id');
                var form = $('#forceDeleteForm');
                var actionUrl = '{{ url('admin/spare-parts') }}/' + sparePartId;
                form.attr('action', actionUrl);
            });
        });
    </script>
@endsection
