<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Serial Number</th>
            <th>Nama Customer</th>
            <th>Email</th>
            <th>HP</th>
            <th>Tipe Produk</th>
            <th>Tipe Service</th>
            <th>Masalah</th>
            <th>Status</th>
            <th>Masalah Aktual</th>
            <th>Receipt (URL)</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($services as $i => $s)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($s->date)->format('d-m-Y') }}</td>
                <td>{{ $s->serial_number }}</td>
                <td>{{ $s->name_customer }}</td>
                <td>{{ $s->email_customer }}</td>
                <td>{{ $s->handphone_customer }}</td>
                <td>{{ $s->type_product }}</td>
                <td>{{ $s->type_service }}</td>
                <td>{{ $s->problem }}</td>
                <td>{{ $s->status }}</td>
                <td>{{ $s->actual_problem }}</td>
                <td>
                    @if ($s->receipt)
                        {!! '=HYPERLINK("' . asset('storage/' . $s->receipt) . '","Bukti Nota")' !!}
                    @else
                        -
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
