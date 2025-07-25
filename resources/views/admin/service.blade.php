@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('styles')

    <style>
        .bg-garansi {
            background-color: #6610f2 !important;
            /* hijau muda */
            color: #fff;
        }

        .bg-non-garansi {
            background-color: #dc3545 !important;
            /* kuning muda */
            color: #fff;
        }

        .price-75 {
            background-color: #0d6efd !important;
            color: #fff !important;
        }

        .price-100 {
            background-color: #fd7e14 !important;
            color: #fff !important;
        }

        .price-250 {
            background-color: #d63384 !important;
            color: #fff !important;
        }
    </style>

@endsection

@section('content')
    <div class="container-fluid pt-4 px-4">
        <h4 class="mb-4">List Service - {{ strtoupper($category) }}</h4>
        <div class="bg-light rounded p-4">
            @if ($services->isEmpty())
                <p class="text-muted">Tidak ada permintaan service pada kategori ini.</p>
            @else
                <div class="d-flex align-items-start justify-content-between mb-3 flex-wrap">
                    {{-- Kiri: Legend Status --}}
                    <div class="me-3">
                        <div class="mb-1">
                            <strong>Status Tipe Service:</strong><br>
                            <span class="badge bg-garansi">Garansi</span>
                            <span class="badge bg-non-garansi">Non Garansi</span>
                        </div>
                        <div>
                            <strong>Status Penyelesaian Service:</strong><br>
                            <span class="badge bg-warning text-dark">ON PROGRESS</span>
                            <span class="badge bg-success">DONE</span>
                        </div>
                    </div>

                    {{-- Kanan: Filter + Export --}}
                    <div class="d-flex flex-column align-items-start align-items-sm-end mb-3">
                        {{-- Dropdown Filter --}}
                        <select id="filterTypeService" class="form-select form-select-sm mb-2" style="width: 200px;">
                            <option value="">-- Semua Tipe Service --</option>
                            <option value="Garansi">Garansi</option>
                            <option value="Non Garansi">Non Garansi</option>
                        </select>

                        {{-- Tombol Export di pojok kanan bawah --}}
                        <a id="btnExportExcel" href="{{ route('admin.service.export', strtolower($category)) }}"
                            class="btn btn-success btn-sm align-self-end">
                            <i class="fa fa-file-excel me-1"></i>Export Excel
                        </a>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="serviceTable" class="table table-bordered table-striped">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Serial Number</th>
                                <th>Nama Pelanggan</th>
                                <th>Email Pelanggan</th>
                                <th>No Handphone</th>
                                <th>Tipe Produk</th>
                                <th>Tipe Service</th>
                                <th>Harga</th>
                                <th>Permasalahan Mesin</th>
                                <th>Nota</th>
                                <th>Status</th>
                                <th>Permasalahan Aktual</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($services as $i => $s)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $s->date->format('d-m-Y') }}</td>
                                    <td class="serial-cell" data-id="{{ $s->id }}">
                                        <div class="serials-wrapper">
                                            @foreach ($s->serials as $ser)
                                                <div class="serial-entry d-flex mb-1">
                                                    <input type="text"
                                                        class="form-control form-control-sm serial-input me-1"
                                                        data-serial-id="{{ $ser->id }}" list="serialList"
                                                        value="{{ $ser->serial_number }}" placeholder="Serial…"
                                                        style="min-width: 200px;">
                                                    <button type="button" class="btn btn-sm btn-danger remove-serial">
                                                        &times;
                                                    </button>
                                                </div>
                                            @endforeach
                                        </div>
                                        <button type="button" class="btn btn-sm btn-success add-serial">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </td>
                                    <td>{{ $s->name_customer }}</td>
                                    <td>{{ $s->email_customer }}</td>
                                    <td>{{ $s->handphone_customer }}</td>
                                    <td>{{ $s->type_product }}</td>
                                    <td>
                                        <select class="form-select form-select-sm type-service-dropdown"
                                            data-id="{{ $s->id }}" data-field="type_service"
                                            style="min-width: 155px; font-size: 0.875rem;">
                                            <option disabled {{ $s->type_service == null ? 'selected' : '' }}>Pilih Tipe
                                                Service</option>
                                            <option value="Garansi" {{ $s->type_service == 'Garansi' ? 'selected' : '' }}>
                                                Garansi</option>
                                            <option value="Non Garansi"
                                                {{ $s->type_service == 'Non Garansi' ? 'selected' : '' }}>Non Garansi
                                            </option>
                                        </select>
                                    </td>
                                    <td>
                                        @php
                                            $cls =
                                                $s->price == 75000
                                                    ? 'price-75'
                                                    : ($s->price == 100000
                                                        ? 'price-100'
                                                        : ($s->price == 250000
                                                            ? 'price-250'
                                                            : ''));
                                        @endphp
                                        <select class="form-select form-select-sm price-dropdown {{ $cls }}"
                                            data-id="{{ $s->id }}" data-field="price"
                                            style="min-width:130px;font-size:0.875rem">
                                            <option disabled {{ is_null($s->price) ? 'selected' : '' }}>Pilih Harga
                                            </option>
                                            <option value="75000" {{ $s->price == 75000 ? 'selected' : '' }}>Rp.75.000,-
                                            </option>
                                            <option value="100000" {{ $s->price == 100000 ? 'selected' : '' }}>Rp.100.000,-
                                            </option>
                                            <option value="250000" {{ $s->price == 250000 ? 'selected' : '' }}>Rp.250.000,-
                                            </option>
                                        </select>
                                    </td>
                                    <td>{{ $s->problem }}</td>
                                    <td>
                                        @if ($s->receipt)
                                            @php
                                                $path = 'storage/' . $s->receipt;
                                                $extension = pathinfo($path, PATHINFO_EXTENSION);
                                            @endphp

                                            <a href="{{ asset($path) }}" target="_blank">
                                                @if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                                    <a href="{{ asset($path) }}" target="_blank"
                                                        class="btn btn-sm btn-outline-dark">
                                                        <i class="fa fa-file-image me-1"></i> IMG
                                                    </a>
                                                @elseif (strtolower($extension) === 'pdf')
                                                    <a href="{{ asset($path) }}" target="_blank"
                                                        class="btn btn-sm btn-outline-danger">
                                                        <i class="fa fa-file-pdf me-1"></i> PDF
                                                    </a>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        <select class="form-select form-select-sm status-dropdown"
                                            data-id="{{ $s->id }}" data-field="status"
                                            style="min-width: 140px; font-size: 0.875rem;">
                                            <option value="ON PROGRESS"
                                                {{ $s->status == 'ON PROGRESS' ? 'selected' : '' }}>ON PROGRESS</option>
                                            <option value="DONE" {{ $s->status == 'DONE' ? 'selected' : '' }}>DONE
                                            </option>
                                        </select>
                                    </td>
                                    <td>
                                        <span class="actual-problem-text">{{ $s->actual_problem ?? '-' }}</span>
                                        <input type="text"
                                            class="form-control form-control-sm actual-problem-input d-none"
                                            value="{{ $s->actual_problem }}">
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-primary btn-toggle-edit"
                                            data-id="{{ $s->id }}">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    <datalist id="serialList"></datalist>
@endsection

@section('scripts')

    {{-- UPDATE STATUS & TYPE SERVICE --}}
    <script>
        function updateDropdownStyle() {
            // existing type-service
            document.querySelectorAll('.type-service-dropdown').forEach(select => {
                select.classList.remove('bg-garansi', 'bg-non-garansi', 'text-white');
                if (select.value === 'Garansi') {
                    select.classList.add('bg-garansi', 'text-white');
                } else if (select.value === 'Non Garansi') {
                    select.classList.add('bg-non-garansi', 'text-white');
                }
            });

            // existing status
            document.querySelectorAll('.status-dropdown').forEach(select => {
                select.classList.remove('bg-warning', 'bg-success', 'text-white', 'text-dark');
                if (select.value === 'DONE') {
                    select.classList.add('bg-success', 'text-white');
                } else {
                    select.classList.add('bg-warning', 'text-dark');
                }
            });

            // **baru: price-dropdown**
            document.querySelectorAll('.price-dropdown').forEach(select => {
                select.classList.remove('price-75', 'price-100', 'price-250', 'text-white', 'text-dark');
                switch (select.value) {
                    case '75000':
                        select.classList.add('price-75', 'text-white');
                        break;
                    case '100000':
                        select.classList.add('price-100', 'text-white');
                        break;
                    case '250000':
                        select.classList.add('price-250', 'text-white');
                        break;
                }
            });
        }

        const updateFieldUrl = @json(route('admin.service.updateField'));

        function sendUpdate(selectElement) {
            const id = selectElement.dataset.id;
            const field = selectElement.dataset.field;
            const value = selectElement.value;

            fetch(updateFieldUrl, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        id,
                        field,
                        value
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        updateDropdownStyle();
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: 'Berhasil disimpan',
                            timer: 1500,
                            showConfirmButton: false
                        });
                    } else {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'error',
                            title: 'Gagal update data',
                            timer: 1500,
                            showConfirmButton: false
                        });
                    }
                })
                .catch(() => {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        title: 'Kesalahan server',
                        timer: 1500,
                        showConfirmButton: false
                    });
                });
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // 1) Daftarkan custom search function (filter by Tipe Service)
            $.fn.dataTable.ext.search.push((settings, data, dataIndex) => {
                if (settings.nTable.id !== 'serviceTable') return true;
                const selectedType = $('#filterTypeService').val();
                if (!selectedType) return true;
                const cellNode = settings.aoData[dataIndex].anCells[7];
                const currentType = $('select.type-service-dropdown', cellNode).val();
                return currentType === selectedType;
            });

            // 2) Inisialisasi DataTable sekali, simpan instance
            const table = $('#serviceTable').DataTable({
                order: [
                    [1, 'desc']
                ]
            });

            // 3) Filter & Export link update
            const exportBtn = document.getElementById('btnExportExcel');
            $('#filterTypeService').on('change', function() {
                table.draw();
                const type = this.value;
                const base = "{{ route('admin.service.export', strtolower($category)) }}";
                exportBtn.href = type ? `${base}?type_service=${type}` : base;
            });

            // 4) Styling awal dropdown
            updateDropdownStyle();

            // 5) Delegasi untuk dropdown type/service
            $('#serviceTable tbody')
                .on('change', '.type-service-dropdown', function() {
                    sendUpdate(this);
                })
                .on('change', '.status-dropdown', function() {
                    sendUpdate(this);
                })
                .on('change', '.price-dropdown', function() {
                    sendUpdate(this);
                });

            // 6) Delegasi untuk tombol edit/save pada actual_problem
            $('#serviceTable tbody').on('click', '.btn-toggle-edit', function() {
                const btn = this;
                const row = btn.closest('tr');
                const span = row.querySelector('.actual-problem-text');
                const input = row.querySelector('.actual-problem-input');
                const icon = btn.querySelector('i');
                const id = btn.getAttribute('data-id');

                if (icon.classList.contains('fa-save')) {
                    // Simpan via AJAX
                    const value = input.value;
                    fetch("{{ route('admin.service.updateField') }}", {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({
                                id,
                                field: 'actual_problem',
                                value
                            }),
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                span.textContent = value || '-';
                                Swal.fire({
                                    toast: true,
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Berhasil disimpan',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }
                        });
                    input.classList.add('d-none');
                    span.classList.remove('d-none');
                    icon.classList.replace('fa-save', 'fa-edit');
                } else {
                    // Masuk mode edit
                    input.classList.remove('d-none');
                    span.classList.add('d-none');
                    input.focus();
                    icon.classList.replace('fa-edit', 'fa-save');
                }
            });

            // 7) Apply ulang styling setiap kali DataTable redraw (paginate, search, sort)
            table.on('draw', function() {
                updateDropdownStyle();
            });
        });
    </script>

    {{-- UPDATE SERIAL NUMBER --}}
    <script>
        const addSerialUrl = @json(route('admin.service.addSerial'));
        const updateSerialUrl = @json(route('admin.service.updateSerial'));
        const deleteSerialUrl = id => @json(route('admin.service.deleteSerial', ['id' => '__ID__'])).replace('__ID__', id);
        const serialNumbersUrl = @json(route('serial-numbers'));

        function loadSerialSuggestions(term) {
            $.get(serialNumbersUrl, {
                    q: term
                })
                .done(data => {
                    const $list = $('#serialList').empty();
                    data.results.forEach(item => {
                        $('<option>')
                            .attr('value', item.text)
                            .appendTo($list);
                    });
                });
        }

        $(function() {
            // 1) Tambah entry baru (belum punya ID)
            $('#serviceTable').on('click', '.add-serial', function() {
                const $cell = $(this).closest('td.serial-cell');
                const svcId = $cell.data('id');
                const $new = $(`
                    <div class="serial-entry d-flex mb-1">
                        <input type="text" class="form-control form-control-sm serial-input me-1"
                            data-serial-id="" list="serialList"
                            placeholder="Serial baru…" style="min-width: 200px;">
                        <button type="button" class="btn btn-sm btn-danger remove-serial">&times;</button>
                    </div>`);
                $cell.find('.serials-wrapper').append($new);
            });

            // 2) Hapus entry
            $('#serviceTable').on('click', '.remove-serial', function() {
                const $entry = $(this).closest('.serial-entry');
                const sid = $entry.find('.serial-input').data('serial-id');
                if (sid) {
                    // hapus via AJAX
                    $.ajax({
                        url: deleteSerialUrl(sid),
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    }).done(() => {
                        $entry.remove();
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: 'Dihapus',
                            showConfirmButton: false,
                            timer: 1500,
                            timerProgressBar: true,
                            customClass: {
                                popup: 'swal2-sm'
                            }
                        });
                    }).fail(() => {
                        Swal.fire('Gagal', 'Tidak bisa menghapus', 'error');
                    });
                } else {
                    // hanya remove DOM
                    $entry.remove();
                }
            });

            // 3) Simpan/Update on blur
            $('#serviceTable').on('blur', '.serial-input', function() {
                const $inp = $(this);
                const val = $inp.val().trim();
                if (!val) return;

                const sid = $inp.data('serial-id');
                const svcId = $inp.closest('td.serial-cell').data('id');

                if (sid) {
                    // update existing
                    $.post(updateSerialUrl, {
                        _token: '{{ csrf_token() }}',
                        id: sid,
                        serial_number: val
                    }).done(data => {
                        Swal.fire({
                            toast: true,
                            position: 'top-end', // Ganti 'bottom-end' kalau mau di kanan bawah
                            icon: 'success',
                            title: 'Diupdate',
                            showConfirmButton: false,
                            timer: 1500,
                            timerProgressBar: true,
                            customClass: {
                                popup: 'swal2-sm'
                            }
                        });
                    });
                } else {
                    // create new
                    $.post(addSerialUrl, {
                        _token: '{{ csrf_token() }}',
                        service_id: svcId,
                        serial_number: val
                    }).done(data => {
                        // pasang data-serial-id agar berikutnya jadi update
                        $inp.data('serial-id', data.id);
                        Swal.fire({
                            toast: true,
                            position: 'top-end', // Ganti 'bottom-end' kalau mau di kanan bawah
                            icon: 'success',
                            title: 'Ditambahkan',
                            showConfirmButton: false,
                            timer: 1500,
                            timerProgressBar: true,
                            customClass: {
                                popup: 'swal2-sm'
                            }
                        });
                    }).fail(() => {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'error',
                            title: 'Terjadi kesalahan saat menyimpan',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    });
                }
            });

            $('#serviceTable').on('input', '.serial-input', function() {
                const term = $(this).val().trim();
                if (term.length >= 1) {
                    loadSerialSuggestions(term);
                }
            });
        });
    </script>


@endsection
