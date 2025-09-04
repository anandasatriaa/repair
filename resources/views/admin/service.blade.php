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

        .form-control:disabled,
        .form-control[readonly] {
            background-color: #ffffff !important;
            opacity: 1;
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
                                <th>Penggunaan Sparepart</th>
                                <th>Estimasi Pengerjaan</th>
                                <th>Nota</th>
                                <th>Status</th>
                                <th>Permasalahan Aktual</th>
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
                                    <td class="sparepart-cell" data-id="{{ $s->id }}">
                                        <div class="spareparts-wrapper">
                                            @foreach ($s->usedSpareParts as $part)
                                                <div class="sparepart-entry d-flex align-items-center mb-1">
                                                    <input type="text" class="form-control form-control-sm me-1"
                                                        value="{{ Str::limit($part->description, 30) }} [{{ $part->item_code }}] (Rp {{ number_format($part->pivot->price_at_time_of_use, 0, ',', '.') }})"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="{{ $part->description }} [{{ $part->item_code }}] (Rp {{ number_format($part->pivot->price_at_time_of_use, 0, ',', '.') }})"
                                                        readonly style="min-width: 300px;">
                                                    <button type="button" class="btn btn-sm btn-danger remove-sparepart"
                                                        data-sparepart-id="{{ $part->id }}">&times;</button>
                                                </div>
                                            @endforeach
                                        </div>
                                        <button type="button" class="btn btn-sm btn-info add-sparepart mt-1">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </td>
                                    <td data-id="{{ $s->id }}" style="min-width: 250px;">
                                        <div class="d-flex align-items-center">
                                            <input type="date" class="form-control form-control-sm estimation-date"
                                                name="estimated_start_date"
                                                value="{{ $s->estimated_start_date ? $s->estimated_start_date->format('Y-m-d') : '' }}"
                                                title="Tanggal Mulai Estimasi">
                                            <span class="mx-2">-</span>
                                            <input type="date" class="form-control form-control-sm estimation-date"
                                                name="estimated_end_date"
                                                value="{{ $s->estimated_end_date ? $s->estimated_end_date->format('Y-m-d') : '' }}"
                                                title="Tanggal Selesai Estimasi">
                                        </div>
                                    </td>
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
                                    <td style="min-width: 250px;">
                                        <input type="text" class="form-control form-control-sm actual-problem-input"
                                            data-id="{{ $s->id }}" data-field="actual_problem"
                                            value="{{ $s->actual_problem }}"
                                            placeholder="Masukkan permasalahan aktual...">
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
    <datalist id="sparepartList"></datalist>
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
        $(function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });

            // --- URL Global untuk AJAX ---
            const addSerialUrl = @json(route('admin.service.addSerial'));
            const updateSerialUrl = @json(route('admin.service.updateSerial'));
            const deleteSerialUrl = id => @json(route('admin.service.deleteSerial', ['id' => '__ID__'])).replace('__ID__', id);
            const serialNumbersUrl = @json(route('serial-numbers'));
            const addSparepartUrl = serviceId => `{{ url('admin/service') }}/${serviceId}/add-sparepart`;
            const removeSparepartUrl = (serviceId, sparepartId) =>
                `{{ url('admin/service') }}/${serviceId}/remove-sparepart/${sparepartId}`;
            const sparepartCodesUrl = @json(route('admin.sparepart-codes'));

            // --- FUNGSI HELPER ---
            function showToast(icon, title) {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: icon,
                    title: title,
                    showConfirmButton: false,
                    timer: 1500
                });
            }

            // --- INISIALISASI & FILTER DATATABLE ---
            $.fn.dataTable.ext.search.push((settings, data, dataIndex) => {
                if (settings.nTable.id !== 'serviceTable') return true;
                const selectedType = $('#filterTypeService').val();
                if (!selectedType) return true;
                const cellNode = settings.aoData[dataIndex].anCells[
                    7]; // Sesuaikan indeks jika posisi kolom berubah
                const currentType = $('select.type-service-dropdown', cellNode).val();
                return currentType === selectedType;
            });

            const table = $('#serviceTable').DataTable({
                order: [
                    [1, 'desc']
                ]
            });

            const exportBtn = document.getElementById('btnExportExcel');
            $('#filterTypeService').on('change', function() {
                table.draw();
                const type = this.value;
                const base = "{{ route('admin.service.export', strtolower($category)) }}";
                exportBtn.href = type ? `${base}?type_service=${type}` : base;
            });

            updateDropdownStyle();

            // --- EVENT HANDLERS UTAMA ---
            const $tableBody = $('#serviceTable tbody');

            // Dropdown (Status, Tipe, Harga) - Menggunakan fungsi sendUpdate global
            $tableBody.on('change', '.type-service-dropdown, .status-dropdown, .price-dropdown', function() {
                sendUpdate(this);
            });

            // Edit Langsung (Permasalahan Aktual)
            $tableBody.on('blur', '.actual-problem-input', function() {
                const $input = $(this);
                const id = $input.data('id');
                const field = $input.data('field');
                const value = $input.val();

                // Kirim data menggunakan fungsi fetch yang sudah ada
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
                            showToast('success', 'Permasalahan disimpan');
                        } else {
                            showToast('error', 'Gagal menyimpan');
                        }
                    })
                    .catch(() => showToast('error', 'Kesalahan server'));
            });

            // Edit Langsung (Tanggal Estimasi)
            $tableBody.on('change', '.estimation-date', function() {
                const $input = $(this);
                $.post(updateFieldUrl, {
                        _token: '{{ csrf_token() }}',
                        id: $input.closest('td').data('id'),
                        field: $input.attr('name'),
                        value: $input.val()
                    })
                    .done(data => {
                        showToast(data.success ? 'success' : 'error', data.success ?
                            'Tanggal disimpan' : 'Gagal menyimpan');
                    });
            });

            // --- LOGIKA SERIAL NUMBER ---
            $tableBody.on('click', '.add-serial', function() {
                const $wrapper = $(this).siblings('.serials-wrapper');
                const $newEntry = $(
                    `<div class="serial-entry d-flex mb-1"><input type="text" class="form-control form-control-sm serial-input me-1" list="serialList" placeholder="Serial baru…"><button type="button" class="btn btn-sm btn-danger remove-serial">&times;</button></div>`
                );
                $wrapper.append($newEntry);
                $newEntry.find('input').focus();
            });
            $tableBody.on('click', '.remove-serial', function() {
                const $entry = $(this).closest('.serial-entry');
                const serialId = $entry.find('.serial-input').data('serial-id');
                if (serialId) {
                    $.ajax({
                            url: deleteSerialUrl(serialId),
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .done(() => {
                            $entry.remove();
                            showToast('success', 'Dihapus');
                        })
                        .fail(() => showToast('error', 'Gagal hapus'));
                } else {
                    $entry.remove();
                }
            });
            $tableBody.on('blur', '.serial-input', function() {
                const $input = $(this);
                const value = $input.val().trim();
                if (!value) return;
                const serialId = $input.data('serial-id');
                const serviceId = $input.closest('.serial-cell').data('id');
                const url = serialId ? updateSerialUrl : addSerialUrl;
                const payload = serialId ? {
                    id: serialId,
                    serial_number: value
                } : {
                    service_id: serviceId,
                    serial_number: value
                };
                payload._token = '{{ csrf_token() }}';
                $.post(url, payload).done(data => {
                    if (!serialId) $input.data('serial-id', data.id);
                    showToast('success', serialId ? 'Diupdate' : 'Ditambahkan');
                }).fail(() => showToast('error', 'Gagal simpan'));
            });
            $tableBody.on('input', '.serial-input', function() {
                const term = $(this).val().trim();
                if (term.length > 1) {
                    $.get(serialNumbersUrl, {
                        q: term
                    }).done(data => {
                        const $list = $('#serialList').empty();
                        data.results.forEach(item => $('<option>').attr('value', item.text)
                            .appendTo($list));
                    });
                }
            });

            // --- LOGIKA SPAREPART (SEPERTI SERIAL NUMBER) ---
            $tableBody.on('click', '.add-sparepart', function() {
                const $wrapper = $(this).siblings('.spareparts-wrapper');
                // Pastikan input menggunakan datalist yang benar
                const $newEntry = $(
                    `<div class="sparepart-entry d-flex mb-1"><input type="text" class="form-control form-control-sm sparepart-input me-1" style="min-width: 300px;" list="sparepartList" placeholder="Cari kode atau nama sparepart…"><button type="button" class="btn btn-sm btn-danger remove-sparepart-transient">&times;</button></div>`
                );
                $wrapper.append($newEntry);
                $newEntry.find('input').focus();
            });

            // Tombol hapus untuk input yang belum disimpan
            $tableBody.on('click', '.remove-sparepart-transient', function() {
                $(this).closest('.sparepart-entry').remove();
            });

            // Simpan sparepart saat input kehilangan fokus (blur)
            $tableBody.on('blur', '.sparepart-input', function() {
                const $input = $(this);
                const value = $input.val().trim();
                if (!value) return;

                // **[PERBAIKAN KUNCI 1]** Ekstrak item_code dari label
                // Kita ambil bagian sebelum " - " karena itu adalah kode itemnya.
                const itemCode = value.split(' - ')[0].trim();

                const serviceId = $input.closest('.sparepart-cell').data('id');

                $.post(addSparepartUrl(serviceId), {
                        _token: '{{ csrf_token() }}',
                        // **[PERBAIKAN KUNCI 2]** Kirim itemCode yang sudah diekstrak
                        item_code: itemCode
                    })
                    .done(response => {
                        if (response.success) {
                            const newItem = response.new_item;
                            const price = new Intl.NumberFormat('id-ID').format(newItem.pivot
                                .price_at_time_of_use);
                            // Buat string untuk value yang dipendekkan
                            const shortValue = (newItem.description.length > 30 ? newItem.description
                                    .substring(0, 30) + '...' : newItem.description) +
                                ` [${newItem.item_code}] (Rp ${price})`;

                            // Buat string untuk title yang lengkap
                            const fullTitle = `${newItem.description} [${newItem.item_code}] (Rp ${price})`;

                            const $newSavedEntry = $(
                                `<div class="sparepart-entry d-flex align-items-center mb-1">
                                    <input type="text" class="form-control form-control-sm me-1" style="min-width: 300px;" 
                                        value="${shortValue}" 
                                        data-bs-toggle="tooltip" 
                                        data-bs-placement="top" 
                                        title="${fullTitle}" 
                                        readonly>
                                    <button type="button" class="btn btn-sm btn-danger remove-sparepart" data-sparepart-id="${newItem.id}">&times;</button>
                                </div>`
                            );

                            $input.closest('.sparepart-entry').replaceWith($newSavedEntry);

                            // Inisialisasi tooltip untuk elemen yang baru ditambahkan
                            $newSavedEntry.find('[data-bs-toggle="tooltip"]').tooltip();

                            showToast('success', 'Sparepart ditambah');
                        } else {
                            showToast('error', response.message || 'Gagal tambah');
                            $input.closest('.sparepart-entry').remove();
                        }
                    }).fail((xhr) => {
                        // Handle jika item_code tidak ditemukan di database
                        const errorMessage = xhr.status === 422 ? 'Kode item tidak valid' :
                            'Error server';
                        showToast('error', errorMessage);
                        $input.closest('.sparepart-entry').remove();
                    });
            });

            // Hapus sparepart yang sudah ada di database
            $tableBody.on('click', '.remove-sparepart', function() {
                const $entry = $(this).closest('.sparepart-entry');
                const sparepartId = $(this).data('sparepart-id');
                const serviceId = $(this).closest('.sparepart-cell').data('id');
                $.ajax({
                        url: removeSparepartUrl(serviceId, sparepartId),
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .done(() => {
                        $entry.remove();
                        showToast('success', 'Sparepart dihapus');
                    })
                    .fail(() => showToast('error', 'Gagal hapus'));
            });

            // Memicu pencarian saat pengguna mengetik
            $tableBody.on('input', '.sparepart-input', function() {
                const term = $(this).val().trim();
                if (term.length > 1) {
                    $.get(sparepartCodesUrl, {
                        q: term
                    }).done(data => {
                        const $list = $('#sparepartList').empty();
                        // **[PERBAIKAN KUNCI 3]** Gunakan 'item.label' dari controller
                        data.forEach(item => {
                            $('<option>').attr('value', item.label).appendTo($list);
                        });
                    });
                }
            });

            // --- FINALISASI ---
            table.on('draw', function() {
                updateDropdownStyle();
            });
        });
    </script>

@endsection
