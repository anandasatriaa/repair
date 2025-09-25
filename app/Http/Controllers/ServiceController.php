<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\ProductService;

class ServiceController extends Controller
{
    public function index()
    {
        return view('form-service');
    }

    public function getSerialNumbers(Request $request)
    {
        $search = $request->query('q');

        // Menggunakan koneksi default (MySQL) ke tabel baru.
        // Langsung format output untuk Select2 agar lebih efisien.
        $results = DB::table('product_warranties')
            ->select('serial_number as id', 'serial_number as text')
            ->where('serial_number', 'like', '%' . $search . '%')
            ->distinct()
            ->limit(20) // Tambahkan limit untuk performa
            ->get();

        return response()->json(['results' => $results]);
    }

    public function getProductDescription(Request $request)
    {
        $serial = $request->query('serial');

        Log::info('[getProductDescription] Mencari serial di tabel lokal: ' . $serial);

        // Cukup satu query ke tabel lokal untuk mendapatkan semua info.
        $product = DB::table('product_warranties')
            ->select('product_description', 'brand_description')
            ->where('serial_number', $serial)
            ->first();

        Log::info('[getProductDescription] Hasil dari tabel lokal: ' . var_export($product, true));

        // Jika tidak ditemukan, kembalikan null
        if (!$product) {
            return response()->json([
                'description' => null,
                'category' => null
            ]);
        }

        // Kembalikan data dari tabel lokal
        return response()->json([
            'description' => $product->product_description,
            'category' => $product->brand_description,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand'             => 'required|in:rupes,ctek,noco',
            'serial_number'     => 'nullable|string',
            'serial_manual'     => 'nullable|string',
            'product_type'      => 'required|string',
            'issue_description' => 'required|string',
            'customer_name'     => 'required|string',
            'customer_email'    => 'nullable|email',
            'customer_phone'    => 'required|string',
            'purchase_proof'    => 'nullable|file|mimes:jpeg,jpg,png,gif,svg,webp,pdf|max:10240',
        ]);

        try {
            // 2) Tentukan serial number
            $serial = $request->brand === 'rupes'
                ? $validated['serial_manual']
                : $validated['serial_number'];

            // 3) Upload if ada file
            $receiptPath = null;
            if ($request->hasFile('purchase_proof')) {
                $receiptPath = $request->file('purchase_proof')
                    ->store('receipts', 'public');
            }

            // 4) Simpan ke DB
            $service = ProductService::create([
                'type_product'       => $validated['product_type'],
                'problem'            => $validated['issue_description'],
                'name_customer'      => $validated['customer_name'],
                'email_customer'     => $validated['customer_email'],
                'handphone_customer' => $validated['customer_phone'],
                'receipt'            => $receiptPath,
                'category'           => strtoupper($validated['brand']),
                'date'               => now(),
                'type_service'       => null,
                'price'              => null,
                'status'             => 'ON PROGRESS',
                'actual_problem'     => null,
            ]);

            if ($serial) {
                $service->serials()->create([
                    'serial_number' => $serial
                ]);
            }

            // 5) Response sesuai type request
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'data'    => $service,
                    'message' => 'Permintaan service berhasil dikirim!'
                ], 201);
            }

            return redirect()->back()->with('success', 'Permintaan service berhasil dikirim!');
        } catch (\Exception $e) {
            Log::error('Store Service Error: ' . $e->getMessage());

            $errorMsg = 'Terjadi kesalahan saat menyimpan data.';
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $errorMsg
                ], 500);
            }

            return redirect()->back()->withErrors($errorMsg);
        }
    }
}
