<!DOCTYPE html>
<html lang="id" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml"
    xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="x-apple-disable-message-reformatting">
    <title>Notifikasi Update Service</title>
</head>

<body style="margin: 0; padding: 0; background-color: #f0f2f5; font-family: Arial, sans-serif;">
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td align="center" style="padding: 20px 0;">

                <table role="presentation" border="0" cellpadding="0" cellspacing="0"
                    style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border: 1px solid #e0e0e0; border-radius: 8px; overflow: hidden;">

                    <tr>
                        <td style="background-color: #0056b3; padding: 20px 30px;">
                            <h2
                                style="margin: 0; color: #ffffff; font-size: 24px; font-weight: bold; text-align: center;">
                                Notifikasi Update Service
                            </h2>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 30px 30px 20px 30px; color: #333333; font-size: 16px; line-height: 1.6;">
                            <p style="margin: 0 0 20px 0;">Halo Admin Staff,</p>
                            <p style="margin: 0 0 25px 0;">
                                Teknisi telah melakukan update: <strong>{{ $updateType }}</strong>. <br>
                                Berikut adalah rincian lengkap service customer:
                            </p>

                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%"
                                style="margin-bottom: 25px; font-size: 14px;">
                                <tr>
                                    <td
                                        style="padding: 10px; border: 1px solid #dddddd; background-color: #f9f9f9; width: 35%; color: #555555;">
                                        <strong>Tanggal Pengajuan</strong>
                                    </td>
                                    <td style="padding: 10px; border: 1px solid #dddddd; color: #333333;">
                                        {{ $service->date->format('d F Y, H:i') }}</td>
                                </tr>
                                <tr>
                                    <td
                                        style="padding: 10px; border: 1px solid #dddddd; background-color: #f9f9f9; width: 35%; color: #555555;">
                                        <strong>Nama Pelanggan</strong>
                                    </td>
                                    <td style="padding: 10px; border: 1px solid #dddddd; color: #333333;">
                                        {{ $service->name_customer }}</td>
                                </tr>
                                <tr>
                                    <td
                                        style="padding: 10px; border: 1px solid #dddddd; background-color: #f9f9f9; width: 35%; color: #555555;">
                                        <strong>Email</strong>
                                    </td>
                                    <td style="padding: 10px; border: 1px solid #dddddd; color: #333333;">
                                        {{ $service->email_customer }}</td>
                                </tr>
                                <tr>
                                    <td
                                        style="padding: 10px; border: 1px solid #dddddd; background-color: #f9f9f9; width: 35%; color: #555555;">
                                        <strong>No. Handphone</strong>
                                    </td>
                                    <td style="padding: 10px; border: 1px solid #dddddd; color: #333333;">
                                        {{ $service->handphone_customer }}</td>
                                </tr>
                                <tr>
                                    <td
                                        style="padding: 10px; border: 1px solid #dddddd; background-color: #f9f9f9; width: 35%; color: #555555;">
                                        <strong>Tipe Produk</strong>
                                    </td>
                                    <td style="padding: 10px; border: 1px solid #dddddd; color: #333333;">
                                        {{ $service->type_product }}</td>
                                </tr>
                                <tr>
                                    <td
                                        style="padding: 10px; border: 1px solid #dddddd; background-color: #f9f9f9; width: 35%; color: #555555; vertical-align: top;">
                                        <strong>Serial Number</strong>
                                    </td>
                                    <td style="padding: 10px; border: 1px solid #dddddd; color: #333333;">
                                        @if ($service->serials->isNotEmpty())
                                            @foreach ($service->serials as $serial)
                                                {{ $serial->serial_number }}<br>
                                            @endforeach
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td
                                        style="padding: 10px; border: 1px solid #dddddd; background-color: #f9f9f9; width: 35%; color: #555555;">
                                        <strong>Tipe Service</strong>
                                    </td>
                                    <td style="padding: 10px; border: 1px solid #dddddd; color: #333333;">
                                        {{ $service->type_service ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td
                                        style="padding: 10px; border: 1px solid #dddddd; background-color: #f9f9f9; width: 35%; color: #555555;">
                                        <strong>Harga Jasa</strong>
                                    </td>
                                    <td
                                        style="padding: 10px; border: 1px solid #dddddd; font-weight: bold; color: #d9232d;">
                                        Rp {{ $service->price ? number_format($service->price, 0, ',', '.') : '0' }},-
                                    </td>
                                </tr>
                                <tr>
                                    <td
                                        style="padding: 10px; border: 1px solid #dddddd; background-color: #f9f9f9; width: 35%; color: #555555; vertical-align: top;">
                                        <strong>Sparepart Digunakan</strong>
                                    </td>
                                    <td style="padding: 10px; border: 1px solid #dddddd; color: #333333;">
                                        @if ($service->usedSpareParts->isNotEmpty())
                                            @foreach ($service->usedSpareParts as $part)
                                                - {{ $part->description }} ({{ $part->item_code }}) : <strong>Rp
                                                    {{ number_format($part->pivot->price_at_time_of_use, 0, ',', '.') }},-</strong><br>
                                            @endforeach
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                            </table>

                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td align="center" style="padding: 10px 0;">
                                        <!--[if mso]>
                                        <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml"
                                                    xmlns:w="urn:schemas-microsoft-com:office:word"
                                                    href="https://repair.milenia-group.com/admin"
                                                    style="height:45px;v-text-anchor:middle;width:250px;"
                                                    arcsize="10%"
                                                    strokecolor="#0056b3"
                                                    fillcolor="#0056b3">
                                            <w:anchorlock/>
                                            <center style="color:#ffffff;font-family:sans-serif;font-size:16px;font-weight:bold;">
                                            Buka Sistem Admin
                                            </center>
                                        </v:roundrect>
                                        <![endif]-->
                                        <!--[if !mso]> -->
                                        <a href="https://repair.milenia-group.com/admin" target="_blank"
                                            style="background-color:#0056b3;color:#ffffff;display:inline-block;
                                            font-size:16px;font-weight:bold;line-height:45px;text-align:center;
                                            text-decoration:none;width:250px;border-radius:5px;">
                                            Buka Sistem Admin
                                        </a>
                                        <!--<![endif]-->
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>

                    <tr>
                        <td align="center"
                            style="padding: 20px 30px; background-color: #f0f2f5; border-top: 1px solid #e0e0e0;">
                            <p style="margin: 0; font-size: 12px; color: #777777;">
                                &copy; {{ date('Y') }} Service System. All rights reserved.
                            </p>
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>
</body>

</html>
