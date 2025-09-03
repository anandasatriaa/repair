<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SparePart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class AdminSparePartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil SEMUA data spare part yang AKTIF
        $activeSpareParts = SparePart::with('currentPrice')->latest()->get();

        // Mengambil SEMUA data spare part yang DIARSIPKAN
        $archivedSpareParts = SparePart::onlyTrashed()->with('currentPrice')->latest()->get();

        // Mengirim kedua set data ke view yang sama
        return view('admin.spareparts.index', compact('activeSpareParts', 'archivedSpareParts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.spareparts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'item_code' => 'required|string|max:255|unique:spare_parts,item_code',
            'description' => 'required|string',
            'brand' => 'required|string|max:100',
            'quantity' => 'nullable|integer',
            'unit' => 'nullable|string|max:50',
            'moq' => 'nullable|integer',
            'price' => 'required|numeric|min:0',
            'effective_date' => 'required|date',
        ]);

        try {
            DB::beginTransaction();
            $sparePart = SparePart::create($request->except(['price', 'effective_date']));
            $sparePart->prices()->create([
                'price' => $request->price,
                'effective_date' => $request->effective_date,
            ]);
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to create spare part: ' . $e->getMessage())->withInput();
        }

        return redirect()->route('admin.spare-parts.index')->with('success', 'Spare part added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SparePart $sparePart)
    {
        $sparePart->load('prices'); // Load semua riwayat harga
        return view('admin.spareparts.show', compact('sparePart'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SparePart $sparePart)
    {
        return view('admin.spareparts.edit', compact('sparePart'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SparePart $sparePart)
    {
        $request->validate([
            'item_code' => 'required|string|max:255|unique:spare_parts,item_code,' . $sparePart->id,
            'description' => 'required|string',
            'brand' => 'required|string|max:100',
            'quantity' => 'nullable|integer',
            'unit' => 'nullable|string|max:50',
            'moq' => 'nullable|integer',
        ]);

        $sparePart->update($request->all());

        return redirect()->route('admin.spare-parts.index')->with('success', 'Spare part updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Cari item termasuk yang sudah diarsip
        $sparePart = SparePart::withTrashed()->findOrFail($id);

        // Cek apakah item sudah diarsip atau belum
        if ($sparePart->trashed()) {
            // Jika sudah diarsip, hapus permanen
            $sparePart->forceDelete();
            return redirect()->route('admin.spare-parts.index')->with('success', 'Spare part deleted permanently.');
        } else {
            // Jika belum, arsipkan (soft delete)
            $sparePart->delete();
            return redirect()->route('admin.spare-parts.index')->with('success', 'Spare part has been successfully archived.');
        }
    }

    public function storePrice(Request $request, SparePart $sparePart)
    {
        $request->validate([
            'price' => 'required|numeric|min:0',
            'effective_date' => 'required|date',
        ]);

        $sparePart->prices()->create($request->all());

        return redirect()->route('admin.spare-parts.show', $sparePart)->with('success', 'New price added successfully.');
    }

    public function restore($id)
    {
        $sparePart = SparePart::withTrashed()->findOrFail($id);
        $sparePart->restore();

        return redirect()->route('admin.spare-parts.index')->with('success', 'Spare part has been successfully restored.');
    }
}
