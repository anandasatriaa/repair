<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductService;
use App\Models\ProductServiceSerial;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ServiceExport;
use App\Models\SparePart;
use Illuminate\Support\Str;

class AdminServiceController extends Controller
{
    public function byCategory($category)
    {
        $services = ProductService::where('category', strtoupper($category))->get();
        $allSpareParts = SparePart::orderBy('item_code')->get();

        return view('admin.service', compact('services', 'category', 'allSpareParts'));
    }

    public function updateField(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:product_services,id',
            'field' => 'required|in:type_service,status,actual_problem,price,estimated_start_date,estimated_end_date',
            'value' => 'nullable'
        ]);

        $service = ProductService::findOrFail($request->id);
        if ($request->field === 'price') {
            $service->price = (int) $request->value;
        } else {
            $service->{$request->field} = $request->value;
        }

        $service->save();

        return response()->json(['success' => true]);
    }

    public function addSerial(Request $r)
    {
        $r->validate([
            'service_id' => 'required|exists:product_services,id',
            'serial_number' => 'required|string'
        ]);
        $serial = ProductServiceSerial::create([
            'product_service_id' => $r->service_id,
            'serial_number' => $r->serial_number
        ]);
        return response()->json($serial, 201);
    }

    public function updateSerial(Request $r)
    {
        $r->validate([
            'id'            => 'required|exists:product_service_serials,id',
            'serial_number' => 'required|string'
        ]);
        $ser = ProductServiceSerial::findOrFail($r->id);
        $ser->serial_number = $r->serial_number;
        $ser->save();
        return response()->json($ser);
    }

    public function deleteSerial($id)
    {
        ProductServiceSerial::findOrFail($id)->delete();
        return response()->json(['deleted' => true]);
    }

    public function export(Request $request, $category)
    {
        $category   = strtoupper($category);
        $typeFilter = $request->query('type_service'); // bisa null

        return Excel::download(
            new ServiceExport($category, $typeFilter),
            'service_' . strtolower($category) .
                ($typeFilter ? "_{$typeFilter}" : '') . '.xlsx'
        );
    }

    public function getSparePartCodes(Request $request)
    {
        $term = $request->get('q');

        $spareParts = SparePart::with('currentPrice') // Eager load harga terkini
            ->where(function ($query) use ($term) {
                $query->where('item_code', 'LIKE', '%' . $term . '%')
                    ->orWhere('description', 'LIKE', '%' . $term . '%'); // Cari di deskripsi juga
            })
            ->limit(10)
            ->get();

        // Format data agar sesuai dengan kebutuhan jQuery UI Autocomplete
        $results = $spareParts->map(function ($part) {
            $price = $part->currentPrice->price ?? 0;
            return [
                'label' => $part->item_code . ' - ' . Str::limit($part->description, 40) . ' (Rp ' . number_format($price) . ')',
                'value' => $part->item_code, // Nilai yang akan masuk ke input field
            ];
        });

        return response()->json($results);
    }

    public function addUsedSparePart(Request $request, ProductService $service)
    {
        // Validasi sekarang menerima item_code dalam bentuk string
        $request->validate([
            'item_code' => 'required|string|exists:spare_parts,item_code'
        ]);

        // Cari spare part berdasarkan item_code
        $sparePart = SparePart::where('item_code', $request->item_code)->with('currentPrice')->firstOrFail();
        $currentPrice = $sparePart->currentPrice->price ?? 0;

        // Cek duplikasi
        $isAlreadyAttached = $service->usedSpareParts()->where('spare_part_id', $sparePart->id)->exists();

        if (!$isAlreadyAttached) {
            $service->usedSpareParts()->attach($sparePart->id, [
                'price_at_time_of_use' => $currentPrice
            ]);
        } else {
            // Jika sudah ada, kirim response error untuk di-handle di frontend
            return response()->json(['success' => false, 'message' => 'Sparepart sudah ditambahkan.'], 409);
        }

        $service->load('usedSpareParts');

        // Kirim juga data spare part yang baru ditambahkan
        $newlyAdded = $service->usedSpareParts()->where('spare_part_id', $sparePart->id)->first();

        return response()->json([
            'success' => true,
            'used_spare_parts' => $service->usedSpareParts,
            'new_item' => $newlyAdded // Kirim item baru untuk diupdate di frontend
        ]);
    }

    public function removeUsedSparePart(ProductService $service, SparePart $sparePart)
    {
        // Menggunakan detach untuk menghapus relasi dari pivot table
        $service->usedSpareParts()->detach($sparePart->id);

        return response()->json(['success' => true]);
    }
}
