<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Serial Number</th>
            <th>Nama Customer</th>
            <th>Email</th>
            <th>No HP</th>
            <th>Tipe Produk</th>
            <th>Tipe Service</th>
            <th>Harga</th>
            <th>Masalah</th>
            <th>Penggunaan Sparepart</th>
            <th>Estimasi Pengerjaan</th>
            <th>Nota</th>
            <th>Status</th>
            <th>Permasalahan Aktual</th>
            <th>Keterangan Dikembalikan</th>
            <th>Bukti Dikembalikan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($services as $i => $s)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($s->date)->format('d-m-Y') }}</td>
                <td>{{ $s->serials->pluck('serial_number')->join(', ') }}</td>
                <td>{{ $s->name_customer }}</td>
                <td>{{ $s->email_customer }}</td>
                <td>{{ $s->handphone_customer }}</td>
                <td>{{ $s->type_product }}</td>
                <td>{{ $s->type_service }}</td>
                <td>{{ $s->price }}</td>
                <td>{{ $s->problem }}</td>
                <td>
                    @if ($s->usedSpareParts->isNotEmpty())
                        {{ $s->usedSpareParts->map(function ($part) {
                                return '- ' .
                                    $part->description .
                                    ' [' .
                                    $part->item_code .
                                    '] (Rp ' .
                                    number_format($part->pivot->price_at_time_of_use, 0, ',', '.') .
                                    ')';
                            })->implode(PHP_EOL) }}
                    @else
                        -
                    @endif
                </td>
                <td>
                    @if ($s->estimated_start_date && $s->estimated_end_date)
                        {{ \Carbon\Carbon::parse($s->estimated_start_date)->format('d-m-Y') }} -
                        {{ \Carbon\Carbon::parse($s->estimated_end_date)->format('d-m-Y') }}
                    @elseif($s->estimated_start_date)
                        Mulai: {{ \Carbon\Carbon::parse($s->estimated_start_date)->format('d-m-Y') }}
                    @else
                        -
                    @endif
                </td>
                <td>
                    @if ($s->receipt)
                        {!! '=HYPERLINK("' . asset('storage/' . $s->receipt) . '","Bukti Nota")' !!}
                    @else
                        -
                    @endif
                </td>
                <td>{{ $s->status }}</td>
                <td>{{ $s->actual_problem }}</td>
                <td>{{ $s->return_description }}</td>
                <td>
                    @if ($s->return_proof)
                        {!! '=HYPERLINK("' . asset('storage/' . $s->return_proof) . '","Lihat Bukti")' !!}
                    @else
                        -
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
