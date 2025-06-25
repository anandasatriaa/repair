<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductServicesSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now()->format('Y-m-d H:i:s');

        $data = [
            [
                'serial_number'     => '56708G27W3004233',
                'type_product'      => 'CTEK CHARGERS 56-708 MXS 10 EU',
                'problem'           => 'Rusak, tidak menyala',
                'name_customer'     => 'Andi',
                'email_customer'    => 'andi@gmail.com',
                'handphone_customer' => '081234567890',
                'receipt'           => 'receipts/pnLVOkoSsHmJcdvlAMJcB7D591O90PsobqZMHohH.png',
                'category'          => 'CTEK',
                'date'              => Carbon::parse('-1 days')->format('Y-m-d H:i:s'),
                'type_service'      => 'Maintenance',
                'status'            => 'ON PROGRESS',
                'actual_problem'    => null,
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'serial_number'     => '40107A26W3000202',
                'type_product'      => 'CTEK CHARGERS CT5 START/STOP EU',
                'problem'           => 'Mati total',
                'name_customer'     => 'Sarah',
                'email_customer'    => 'sarah@gmail.com',
                'handphone_customer' => '089876544321',
                'receipt'           => 'receipts/m7s04dkIQJcL7q137OzqUwtSo93qR1FGmeSFM4eB.pdf',
                'category'          => 'CTEK',
                'date'              => Carbon::parse('-2 days')->format('Y-m-d H:i:s'),
                'type_service'      => 'Garansi',
                'status'            => 'DONE',
                'actual_problem'    => 'Sudah diperbaiki dan berfungsi normal',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            // Baris 3–11: data dummy lainnya
        ];

        // Generate 9 record tambahan:
        for ($i = 3; $i <= 11; $i++) {
            $data[] = [
                'serial_number'      => 'CTEK-SN-' . str_pad($i, 6, '0', STR_PAD_LEFT),
                'type_product'       => 'CTEK CHARGERS MODEL-' . $i,
                'problem'            => ['Tidak mengisi', 'Lampu indikator mati', 'Overheat', 'Suara berisik', 'Port rusak'][$i % 5],
                'name_customer'      => 'Customer ' . $i,
                'email_customer'     => 'customer' . $i . '@example.com',
                'handphone_customer' => '0812' . rand(1000000, 9999999),
                'receipt'            => ($i % 2 === 0)
                    ? 'receipts/sample' . $i . '.png'
                    : 'receipts/sample' . $i . '.pdf',
                'category'           => 'CTEK',
                'date'               => Carbon::now()->subDays($i)->format('Y-m-d H:i:s'),
                'type_service'       => $i % 3 === 0 ? 'Non Garansi' : ($i % 3 === 1 ? 'Garansi' : 'Maintenance'),
                'status'             => $i % 2 === 0 ? 'DONE' : 'ON PROGRESS',
                'actual_problem'     => $i % 2 === 0 ? 'Perbaikan selesai' : null,
                'created_at'         => $now,
                'updated_at'         => $now,
            ];
        }

        DB::table('product_services')->insert($data);
    }
}
