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

        .price-150 {
            background-color: #198754 !important;
            color: #fff !important;
        }

        .price-200 {
            background-color: #6f42c1 !important;
            color: #fff !important;
        }

        .price-250 {
            background-color: #d63384 !important;
            color: #fff !important;
        }

        .price-custom {
            background-color: #6c757d !important;
            color: #fff !important;
        }

        .form-control:disabled,
        .form-control[readonly] {
            background-color: #ffffff !important;
            opacity: 1;
        }

        .serial-cell {
            min-width: 250px;
            vertical-align: top;
        }

        /* Class baru untuk dropdown di tabel agar rapi */
        .table-select {
            font-size: 0.875rem;
            cursor: pointer;
            border-radius: 4px;
        }

        /* Lebar spesifik per tipe dropdown agar tabel tidak goyang */
        .w-select-type {
            min-width: 160px;
        }

        .w-select-price {
            min-width: 140px;
        }

        .w-select-status {
            min-width: 210px;
        }

        /* Area Input Textarea Tabel */
        .table-textarea {
            min-width: 250px;
            font-size: 0.875rem;
            resize: vertical;
            /* User bisa resize vertikal saja */
        }

        /* --- FOTO THUMBNAIL --- */
        .img-thumbnail-custom {
            height: 60px;
            width: auto;
            border-radius: 4px;
            border: 1px solid #dee2e6;
            padding: 2px;
            cursor: pointer;
            transition: transform 0.2s;
            object-fit: cover;
        }

        .img-thumbnail-custom:hover {
            transform: scale(1.05);
            border-color: #0d6efd;
        }
    </style>

@endsection

@section('content')
    <div class="container-fluid pt-4 px-4">
        <h4 class="mb-4">List Service - {{ strtoupper($category) }}</h4>
        <div class="bg-light rounded p-4">
            @if ($services->isEmpty())
                <div class="text-center py-5">
                    <i class="fa fa-folder-open fa-3x text-muted mb-3"></i>
                    <p class="text-muted">Tidak ada permintaan service pada kategori ini.</p>
                </div>
            @else
                {{-- HEADER TOOLBAR: LEGEND & ACTION --}}
                <div
                    class="d-flex flex-column flex-lg-row justify-content-between align-items-start align-items-lg-end mb-4 gap-3">

                    {{-- Kiri: Legend Status --}}
                    <div class="d-flex flex-column gap-2 p-3 border rounded bg-white w-100 w-lg-auto">
                        <div>
                            <small class="text-muted fw-bold">Status Tipe Service:</small><br>
                            <span class="badge bg-garansi">Garansi</span>
                            <span class="badge bg-non-garansi">Non Garansi</span>
                        </div>
                        <div>
                            <small class="text-muted fw-bold">Status Penyelesaian:</small><br>
                            <span class="badge bg-warning text-dark">ON PROGRESS</span>
                            <span class="badge bg-info">APPROVAL CUSTOMER</span>
                            <span class="badge bg-success">DONE</span>
                        </div>
                    </div>

                    {{-- Kanan: Filter + Export --}}
                    {{-- Di HP: Full Width & Stacked. Di Desktop: Inline --}}
                    <div class="d-flex flex-column flex-md-row gap-2 w-100 w-lg-auto">

                        {{-- Dropdown Filter --}}
                        <select id="filterTypeService" class="form-select w-100 w-md-auto">
                            <option value="">-- Semua Tipe Service --</option>
                            <option value="Garansi">Garansi</option>
                            <option value="Non Garansi">Non Garansi</option>
                        </select>

                        {{-- Tombol Export --}}
                        <a id="btnExportExcel" href="{{ route('admin.service.export', strtolower($category)) }}"
                            class="btn btn-success w-100 w-md-auto text-nowrap">
                            <i class="fa fa-file-excel me-1"></i>Export Excel
                        </a>
                    </div>
                </div>

                <div class="table-responsive">
                    {{-- Tambahkan class align-middle agar isi tabel rapi vertikal --}}
                    <table id="serviceTable" class="table table-bordered table-striped align-middle">
                        <thead class="table-light text-center text-nowrap">
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Serial Number</th>
                                <th>Nama Pelanggan</th>
                                <th>Email</th>
                                <th>No HP</th>
                                <th>Tipe Produk</th>
                                <th>Tipe Service</th>
                                <th>Harga</th>
                                <th>Permasalahan Mesin</th>
                                <th>Penggunaan Sparepart</th>
                                <th>Estimasi Pengerjaan</th>
                                <th>Nota</th>
                                <th>Status</th>
                                <th>Permasalahan Aktual</th>
                                <th>Ket. Dikembalikan</th>
                                <th>Bukti Dikembalikan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($services as $i => $s)
                                <tr>
                                    <td class="text-center">{{ $i + 1 }}</td>
                                    <td class="text-nowrap">{{ $s->date->format('d-m-Y') }}</td>

                                    {{-- Serial Number --}}
                                    <td class="serial-cell" data-id="{{ $s->id }}">
                                        <div class="serials-wrapper">
                                            @foreach ($s->serials as $ser)
                                                <div class="serial-entry d-flex mb-1">
                                                    <input type="text"
                                                        class="form-control form-control-sm serial-input me-1"
                                                        data-serial-id="{{ $ser->id }}" list="serialList"
                                                        value="{{ $ser->serial_number }}" placeholder="Serial…"
                                                        style="min-width: 180px;">
                                                    <button type="button" class="btn btn-sm btn-danger remove-serial">
                                                        &times;
                                                    </button>
                                                </div>
                                            @endforeach
                                        </div>
                                        <button type="button" class="btn btn-sm btn-success add-serial mt-1 w-100">
                                            <i class="fa fa-plus me-1"></i>Serial
                                        </button>
                                    </td>

                                    <td>{{ $s->name_customer }}</td>
                                    <td>{{ $s->email_customer }}</td>
                                    <td>{{ $s->handphone_customer }}</td>
                                    <td>{{ $s->type_product }}</td>

                                    {{-- Tipe Service Dropdown --}}
                                    <td>
                                        <select
                                            class="form-select form-select-sm type-service-dropdown table-select w-select-type"
                                            data-id="{{ $s->id }}" data-field="type_service">
                                            <option disabled {{ $s->type_service == null ? 'selected' : '' }}>Pilih Tipe
                                            </option>
                                            <option value="Garansi" {{ $s->type_service == 'Garansi' ? 'selected' : '' }}>
                                                Garansi</option>
                                            <option value="Non Garansi"
                                                {{ $s->type_service == 'Non Garansi' ? 'selected' : '' }}>Non Garansi
                                            </option>
                                        </select>
                                    </td>

                                    {{-- Harga Dropdown --}}
                                    <td>
                                        @php
                                            $predefinedPrices = [75000, 100000, 150000, 200000, 250000];
                                            $isCustom =
                                                !is_null($s->price) &&
                                                !in_array($s->price, $predefinedPrices) &&
                                                $s->price > 0;

                                            $cls = '';
                                            if ($s->price == 75000) {
                                                $cls = 'price-75';
                                            } elseif ($s->price == 100000) {
                                                $cls = 'price-100';
                                            } elseif ($s->price == 150000) {
                                                $cls = 'price-150';
                                            } elseif ($s->price == 200000) {
                                                $cls = 'price-200';
                                            } elseif ($s->price == 250000) {
                                                $cls = 'price-250';
                                            } elseif ($isCustom) {
                                                $cls = 'price-custom';
                                            }
                                        @endphp

                                        <select
                                            class="form-select form-select-sm price-dropdown table-select w-select-price {{ $cls }}"
                                            data-id="{{ $s->id }}" data-field="price">
                                            <option disabled {{ is_null($s->price) ? 'selected' : '' }}>Pilih Harga
                                            </option>
                                            <option value="75000" {{ $s->price == 75000 ? 'selected' : '' }}>Rp.75.000,-
                                            </option>
                                            <option value="100000" {{ $s->price == 100000 ? 'selected' : '' }}>Rp.100.000,-
                                            </option>
                                            <option value="150000" {{ $s->price == 150000 ? 'selected' : '' }}>Rp.150.000,-
                                            </option>
                                            <option value="200000" {{ $s->price == 200000 ? 'selected' : '' }}>Rp.200.000,-
                                            </option>
                                            <option value="250000" {{ $s->price == 250000 ? 'selected' : '' }}>Rp.250.000,-
                                            </option>

                                            {{-- Jika harga di DB adalah harga custom, tampilkan sebagai opsi terpilih --}}
                                            @if ($isCustom)
                                                <option value="{{ $s->price }}" selected>
                                                    Rp.{{ number_format($s->price, 0, ',', '.') }},-</option>
                                            @endif

                                            <option value="other" style="font-weight: bold; color: #000;">+ Lainnya...
                                            </option>
                                        </select>
                                    </td>

                                    <td>{{ $s->problem }}</td>

                                    {{-- Sparepart --}}
                                    <td class="sparepart-cell" data-id="{{ $s->id }}">
                                        <div class="spareparts-wrapper">
                                            @foreach ($s->usedSpareParts as $part)
                                                <div class="sparepart-entry d-flex align-items-center mb-1">
                                                    <input type="text" class="form-control form-control-sm me-1"
                                                        value="{{ Str::limit($part->description, 20) }}..."
                                                        data-bs-toggle="tooltip"
                                                        title="{{ $part->description }} [{{ $part->item_code }}] (Rp {{ number_format($part->pivot->price_at_time_of_use, 0, ',', '.') }})"
                                                        readonly style="min-width: 200px;">
                                                    <button type="button" class="btn btn-sm btn-danger remove-sparepart"
                                                        data-sparepart-id="{{ $part->id }}">&times;</button>
                                                </div>
                                            @endforeach
                                        </div>
                                        <button type="button"
                                            class="btn btn-sm btn-info add-sparepart mt-1 w-100 text-white">
                                            <i class="fa fa-plus me-1"></i>Part
                                        </button>
                                    </td>

                                    {{-- Estimasi --}}
                                    <td data-id="{{ $s->id }}" style="min-width: 280px;">
                                        <div class="d-flex align-items-center gap-1">
                                            <input type="date" class="form-control form-control-sm estimation-date"
                                                name="estimated_start_date"
                                                value="{{ $s->estimated_start_date ? $s->estimated_start_date->format('Y-m-d') : '' }}">
                                            <span>-</span>
                                            <input type="date" class="form-control form-control-sm estimation-date"
                                                name="estimated_end_date"
                                                value="{{ $s->estimated_end_date ? $s->estimated_end_date->format('Y-m-d') : '' }}">
                                        </div>
                                    </td>

                                    {{-- Nota --}}
                                    <td class="text-center">
                                        @if ($s->receipt)
                                            @php
                                                $path = 'storage/' . $s->receipt;
                                                $extension = pathinfo($path, PATHINFO_EXTENSION);
                                                $fullUrl = asset($path);
                                            @endphp
                                            @if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                                <a href="{{ $fullUrl }}"
                                                    data-fancybox="gallery-receipt-{{ $s->id }}"
                                                    data-caption="Nota - {{ $s->name_customer }}">
                                                    <img src="{{ $fullUrl }}" class="img-thumbnail-custom"
                                                        alt="Nota">
                                                </a>
                                            @elseif (strtolower($extension) === 'pdf')
                                                <a href="{{ $fullUrl }}" target="_blank"
                                                    class="btn btn-sm btn-outline-danger">
                                                    <i class="fa fa-file-pdf"></i> PDF
                                                </a>
                                            @else
                                                <a href="{{ $fullUrl }}" target="_blank"
                                                    class="btn btn-sm btn-outline-secondary">
                                                    <i class="fa fa-file"></i> File
                                                </a>
                                            @endif
                                        @else
                                            -
                                        @endif
                                    </td>

                                    {{-- Status Dropdown --}}
                                    <td>
                                        <select
                                            class="form-select form-select-sm status-dropdown table-select w-select-status"
                                            data-id="{{ $s->id }}" data-field="status">
                                            <option value="ON PROGRESS"
                                                {{ $s->status == 'ON PROGRESS' ? 'selected' : '' }}>ON PROGRESS</option>
                                            <option value="APPROVAL CUSTOMER"
                                                {{ $s->status == 'APPROVAL CUSTOMER' ? 'selected' : '' }}>APPROVAL CUSTOMER
                                            </option>
                                            <option value="DONE" {{ $s->status == 'DONE' ? 'selected' : '' }}>DONE
                                            </option>
                                        </select>
                                    </td>

                                    {{-- Permasalahan Aktual --}}
                                    <td>
                                        <textarea class="form-control form-control-sm actual-problem-input table-textarea" data-id="{{ $s->id }}"
                                            data-field="actual_problem" rows="2" placeholder="Masalah aktual...">{{ $s->actual_problem }}</textarea>
                                    </td>

                                    {{-- Ket Dikembalikan --}}
                                    <td>
                                        <textarea class="form-control form-control-sm return-description-input table-textarea" data-id="{{ $s->id }}"
                                            data-field="return_description" rows="2" placeholder="Keterangan...">{{ $s->return_description }}</textarea>
                                    </td>

                                    {{-- Bukti Dikembalikan --}}
                                    <td style="min-width: 220px;">
                                        <div class="d-flex flex-column gap-2">
                                            <div id="proof-container-{{ $s->id }}" class="text-center">
                                                @if ($s->return_proof)
                                                    <a href="{{ asset('storage/' . $s->return_proof) }}"
                                                        data-fancybox="gallery-proof-{{ $s->id }}"
                                                        data-caption="Bukti Dikembalikan - {{ $s->name_customer }}">
                                                        <img src="{{ asset('storage/' . $s->return_proof) }}"
                                                            class="img-thumbnail-custom" alt="Bukti">
                                                    </a>
                                                @else
                                                    <span class="text-muted small fst-italic no-proof-text">Belum ada
                                                        bukti</span>
                                                @endif
                                            </div>

                                            <div>
                                                <input type="file"
                                                    class="form-control form-control-sm return-proof-input"
                                                    data-id="{{ $s->id }}" accept="image/*">
                                                <div class="text-end">
                                                    <small class="text-danger" style="font-size: 0.65rem;">Max:
                                                        2MB</small>
                                                </div>
                                            </div>
                                        </div>
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

    <script>
        // Inisialisasi Fancybox
        Fancybox.bind("[data-fancybox]", {
            // Opsi kustom jika diperlukan
            Toolbar: {
                display: {
                    left: ["infobar"],
                    middle: ["zoomIn", "zoomOut", "toggle1to1", "rotateCCW", "rotateCW"],
                    right: ["slideshow", "thumbs", "close"],
                },
            },
        });
    </script>

    {{-- UPDATE STATUS & TYPE SERVICE --}}
    <script>
        // FUNGSI GLOBAL BARU UNTUK MENAMPILKAN LOADING
        function showLoadingToast() {
            Swal.fire({
                toast: true,
                position: 'top-end',
                title: 'Mengirim notifikasi...',
                showConfirmButton: false, // Sembunyikan tombol OK
                didOpen: () => {
                    Swal.showLoading(); // Tampilkan ikon loading bawaan
                }
            });
        }

        // FUNGSI GLOBAL UNTUK MENAMPILKAN TOAST (SUDAH ADA SEBELUMNYA)
        function showToast(icon, title) {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: icon,
                title: title,
                showConfirmButton: false,
                timer: 2000 // durasi sedikit lebih lama agar terbaca
            });
        }

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
                select.classList.remove('bg-warning', 'bg-info', 'bg-success', 'text-white', 'text-dark');
                if (select.value === 'DONE') {
                    select.classList.add('bg-success', 'text-white');
                } else if (select.value === 'APPROVAL CUSTOMER') {
                    select.classList.add('bg-info', 'text-white');
                } else { // ON PROGRESS
                    select.classList.add('bg-warning', 'text-dark');
                }
            });

            // **baru: price-dropdown**
            document.querySelectorAll('.price-dropdown').forEach(select => {
                select.classList.remove('price-75', 'price-100', 'price-150', 'price-200', 'price-250',
                    'price-custom', 'text-white');
                const val = select.value;
                if (val === '75000') select.classList.add('price-75', 'text-white');
                else if (val === '100000') select.classList.add('price-100', 'text-white');
                else if (val === '150000') select.classList.add('price-150', 'text-white');
                else if (val === '200000') select.classList.add('price-200', 'text-white');
                else if (val === '250000') select.classList.add('price-250', 'text-white');
                else if (val !== '' && val !== 'other') select.classList.add('price-custom', 'text-white');
            });
        }

        const updateFieldUrl = @json(route('admin.service.updateField'));

        function sendUpdate(selectElement) {
            const id = selectElement.dataset.id;
            const field = selectElement.dataset.field;
            const value = selectElement.value;
            const isPriceUpdate = field === 'price'; // Cek apakah ini update harga

            if (isPriceUpdate) {
                showLoadingToast(); // MODIFIKASI: Panggil loading toast
            }

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
                .then(res => {
                    if (!res.ok) {
                        // Jika server merespon dengan error (misal: 500), lempar error
                        throw new Error('Server response was not ok.');
                    }
                    return res.json();
                })
                .then(data => {
                    if (isPriceUpdate) Swal.close(); // MODIFIKASI: Tutup Swal saat selesai
                    if (data.success) {
                        updateDropdownStyle();
                        showToast('success', 'Berhasil disimpan');
                    } else {
                        showToast('error', 'Gagal update data');
                    }
                })
                .catch(() => {
                    if (isPriceUpdate) Swal.close(); // MODIFIKASI: Tutup Swal jika error
                    showToast('error', 'Kesalahan server, email mungkin gagal terkirim.');
                });
        }
    </script>

    <script>
        $(function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });

            // --- URL Global untuk AJAX (TETAP SAMA) ---
            const addSerialUrl = @json(route('admin.service.addSerial'));
            const updateSerialUrl = @json(route('admin.service.updateSerial'));
            const deleteSerialUrl = id => @json(route('admin.service.deleteSerial', ['id' => '__ID__'])).replace('__ID__', id);
            const serialNumbersUrl = @json(route('serial-numbers'));
            const addSparepartUrl = serviceId => `{{ url('admin/service') }}/${serviceId}/add-sparepart`;
            const removeSparepartUrl = (serviceId, sparepartId) =>
                `{{ url('admin/service') }}/${serviceId}/remove-sparepart/${sparepartId}`;
            const sparepartCodesUrl = @json(route('admin.sparepart-codes'));

            // --- INISIALISASI & FILTER DATATABLE (TETAP SAMA) ---
            $.fn.dataTable.ext.search.push((settings, data, dataIndex) => {
                if (settings.nTable.id !== 'serviceTable') return true;
                const selectedType = $('#filterTypeService').val();
                if (!selectedType) return true;
                const cellNode = settings.aoData[dataIndex].anCells[7];
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

            // --- EVENT HANDLERS UTAMA (TETAP SAMA) ---
            const $tableBody = $('#serviceTable tbody');

            $tableBody.on('change', '.type-service-dropdown, .status-dropdown', function() {
                sendUpdate(this);
            });

            $tableBody.on('change', '.price-dropdown', function() {
                const $select = $(this);
                const val = $select.val();

                if (val === 'other') {
                    Swal.fire({
                        title: 'Input Harga Manual',
                        input: 'number',
                        inputLabel: 'Masukkan nominal harga (angka saja)',
                        inputPlaceholder: 'Contoh: 175000',
                        showCancelButton: true,
                        confirmButtonText: 'Simpan',
                        cancelButtonText: 'Batal',
                        inputValidator: (value) => {
                            if (!value || value <= 0) {
                                return 'Harga harus lebih dari 0!'
                            }
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const manualPrice = result.value;

                            $select.find('option[value="other"]').before(
                                `<option value="${manualPrice}" selected>Rp.${parseInt(manualPrice).toLocaleString('id-ID')},-</option>`
                            );

                            sendUpdate($select[0]);
                        } else {
                            location.reload();
                        }
                    });
                } else {
                    sendUpdate(this);
                }
            });

            $tableBody.on('blur', '.actual-problem-input, .return-description-input', function() {
                const $input = $(this);
                const id = $input.data('id');
                const field = $input.data('field');
                const value = $input.val();

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
                        showToast(data.success ? 'success' : 'error', data.success ?
                            'Permasalahan disimpan' : 'Gagal menyimpan');
                    })
                    .catch(() => showToast('error', 'Kesalahan server'));
            });

            const uploadProofUrl = @json(route('admin.service.uploadReturnProof'));

            $tableBody.on('change', '.return-proof-input', function() {
                const $input = $(this);
                const file = this.files[0];
                const id = $input.data('id');

                // 1. Cek apakah ada file
                if (!file) return;

                // 2. Cek Tipe File (Harus Gambar)
                if (!file.type.match('image.*')) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Format Salah',
                        text: 'Hanya file gambar (JPG, PNG, dll) yang diperbolehkan.',
                        confirmButtonColor: '#3085d6',
                    });
                    $input.val(''); // Reset input
                    return;
                }

                // 3. Cek Ukuran File (Max 2MB)
                // 2MB = 2 * 1024 * 1024 bytes = 2,097,152 bytes
                const maxSize = 2 * 1024 * 1024;

                if (file.size > maxSize) {
                    Swal.fire({
                        icon: 'error',
                        title: 'File Terlalu Besar!',
                        text: 'Ukuran foto maksimal adalah 2MB. Silakan kompres foto Anda atau pilih foto lain.',
                        confirmButtonColor: '#d33',
                    });

                    $input.val(''); // Reset input agar user bisa memilih ulang
                    return; // Hentikan proses, jangan lanjut ke AJAX
                }

                const formData = new FormData();
                formData.append('id', id);
                formData.append('file', file);
                formData.append('_token', '{{ csrf_token() }}');

                showLoadingToast(); // Tampilkan loading

                $.ajax({
                    url: uploadProofUrl,
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        Swal.close();
                        if (response.success) {
                            showToast('success', 'Bukti berhasil diupload');

                            const container = $(`#proof-container-${id}`);

                            // Hapus teks "Belum ada bukti" jika ada
                            container.find('.no-proof-text').remove();

                            // Replace isi container dengan gambar baru yang terbungkus Fancybox
                            container.html(`
                                <a href="${response.path}" 
                                   data-fancybox="gallery-proof-${id}" 
                                   data-caption="Bukti Dikembalikan (Baru)">
                                    <img src="${response.path}" 
                                         class="img-thumbnail-custom" alt="Bukti">
                                </a>
                            `);

                            // Reset input file agar bisa upload ulang file yang sama jika perlu
                            $input.val('');
                        } else {
                            showToast('error', response.message || 'Gagal upload');
                        }
                    },
                    error: function() {
                        Swal.close();
                        showToast('error', 'Terjadi kesalahan saat upload');
                    }
                });
            });

            $tableBody.on('change', '.estimation-date', function() {
                const $input = $(this);
                $.post(updateFieldUrl, {
                    _token: '{{ csrf_token() }}',
                    id: $input.closest('td').data('id'),
                    field: $input.attr('name'),
                    value: $input.val()
                }).done(data => {
                    showToast(data.success ? 'success' : 'error', data.success ?
                        'Tanggal disimpan' : 'Gagal menyimpan');
                });
            });

            // --- LOGIKA SERIAL NUMBER (TETAP SAMA) ---
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

            // --- LOGIKA SPAREPART ---
            $tableBody.on('click', '.add-sparepart', function() {
                const $wrapper = $(this).siblings('.spareparts-wrapper');
                const $newEntry = $(
                    `<div class="sparepart-entry d-flex mb-1"><input type="text" class="form-control form-control-sm sparepart-input me-1" style="min-width: 300px;" list="sparepartList" placeholder="Cari kode atau nama sparepart…"><button type="button" class="btn btn-sm btn-danger remove-sparepart-transient">&times;</button></div>`
                );
                $wrapper.append($newEntry);
                $newEntry.find('input').focus();
            });

            $tableBody.on('click', '.remove-sparepart-transient', function() {
                $(this).closest('.sparepart-entry').remove();
            });

            // Simpan sparepart saat input kehilangan fokus (blur)
            $tableBody.on('blur', '.sparepart-input', function() {
                const $input = $(this);
                const value = $input.val().trim();
                if (!value) return;

                const itemCode = value.split(' - ')[0].trim();
                const serviceId = $input.closest('.sparepart-cell').data('id');

                // ## REVISI DI SINI ##
                // Menggunakan loading toast non-blokir
                showLoadingToast();

                $.post(addSparepartUrl(serviceId), {
                        _token: '{{ csrf_token() }}',
                        item_code: itemCode
                    })
                    .done(response => {
                        Swal.close(); // Tutup loading
                        if (response.success) {
                            const newItem = response.new_item;
                            const price = new Intl.NumberFormat('id-ID').format(newItem.pivot
                                .price_at_time_of_use);
                            const shortValue = (newItem.description.length > 30 ? newItem.description
                                    .substring(0, 30) + '...' : newItem.description) +
                                ` [${newItem.item_code}] (Rp ${price})`;
                            const fullTitle =
                                `${newItem.description} [${newItem.item_code}] (Rp ${price})`;
                            const $newSavedEntry = $(
                                `<div class="sparepart-entry d-flex align-items-center mb-1">
                                <input type="text" class="form-control form-control-sm me-1" style="min-width: 300px;" value="${shortValue}" data-bs-toggle="tooltip" data-bs-placement="top" title="${fullTitle}" readonly>
                                <button type="button" class="btn btn-sm btn-danger remove-sparepart" data-sparepart-id="${newItem.id}">&times;</button>
                            </div>`
                            );
                            $input.closest('.sparepart-entry').replaceWith($newSavedEntry);
                            $newSavedEntry.find('[data-bs-toggle="tooltip"]').tooltip();
                            showToast('success', 'Sparepart ditambah');
                        } else {
                            showToast('error', response.message || 'Gagal tambah');
                            $input.closest('.sparepart-entry').remove();
                        }
                    }).fail((xhr) => {
                        Swal.close(); // Tutup loading
                        const errorMessage = xhr.status === 409 ? 'Sparepart ini sudah ada.' : (xhr
                            .status === 422 ? 'Kode item tidak valid' : 'Error server');
                        showToast('error', errorMessage);
                        $input.closest('.sparepart-entry').remove();
                    });
            });

            // Hapus sparepart yang sudah ada di database
            $tableBody.on('click', '.remove-sparepart', function() {
                const $button = $(this);
                const $entry = $button.closest('.sparepart-entry');
                const sparepartId = $button.data('sparepart-id');
                const serviceId = $button.closest('.sparepart-cell').data('id');

                // ## REVISI DI SINI ##
                // Menggunakan loading toast non-blokir
                showLoadingToast();

                $.ajax({
                        url: removeSparepartUrl(serviceId, sparepartId),
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .done(() => {
                        Swal.close(); // Tutup loading
                        $entry.remove();
                        showToast('success', 'Sparepart dihapus');
                    })
                    .fail(() => {
                        Swal.close(); // Tutup loading
                        showToast('error', 'Gagal hapus');
                    });
            });

            // Memicu pencarian saat pengguna mengetik (TETAP SAMA)
            $tableBody.on('input', '.sparepart-input', function() {
                const term = $(this).val().trim();
                if (term.length > 1) {
                    $.get(sparepartCodesUrl, {
                        q: term
                    }).done(data => {
                        const $list = $('#sparepartList').empty();
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
