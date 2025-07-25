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

        $results = DB::connection('firebird')
            ->table('CGARANSIOUTDETAIL')
            ->select('CGDSN')
            ->where('CGDSN', 'like', '%' . $search . '%')
            ->distinct()
            ->get()
            ->map(function ($row) {
                return [
                    'id' => $row->CGDSN,
                    'text' => $row->CGDSN
                ];
            });

        return response()->json(['results' => $results]);
    }

    public function getProductDescription(Request $request)
    {
        $serial = $request->query('serial');

        // Trim padding spasi di sisi Firebird
        $itemID = DB::connection('firebird')
            ->table('CGARANSIOUTDETAIL')
            ->selectRaw('TRIM(CGDITEMID) as CGDITEMID')  // optional: trim ITEMID juga
            ->whereRaw('TRIM(CGDSN) = ?', [$serial])
            ->value('CGDITEMID');

        Log::info('[getProductDescription] serial: ' . $serial);
        Log::info('[getProductDescription] CGDITEMID (trimmed): ' . var_export($itemID, true));

        if (!$itemID) {
            Log::warning('[getProductDescription] itemID null for serial ' . $serial);
            return response()->json([
                'description' => null,
                'category' => null
            ]);
        }

        $product = DB::connection('sqlsrv-snx')
            ->table('MFIMA')
            ->leftJoin('MFIB', 'MFIMA.MFIMA_Brand', '=', 'MFIB.MFIB_BrandID')
            ->select('MFIMA.MFIMA_Description', 'MFIB.MFIB_Description as BrandDescription')
            ->where('MFIMA.MFIMA_ItemID', $itemID)
            ->first();

        Log::info('[getProductDescription] description: ' . var_export($product, true));

        return response()->json([
            'description' => $product->MFIMA_Description ?? null,
            'category' => $product->BrandDescription ?? null,
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
            'customer_email'    => 'required|email',
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
