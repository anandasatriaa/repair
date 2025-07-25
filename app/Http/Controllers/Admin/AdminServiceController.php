<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductService;
use App\Models\ProductServiceSerial;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ServiceExport;

class AdminServiceController extends Controller
{
    public function byCategory($category)
    {
        $services = ProductService::where('category', strtoupper($category))->get();

        return view('admin.service', compact('services', 'category'));
    }

    public function updateField(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:product_services,id',
            'field' => 'required|in:type_service,status,actual_problem,price',
            'value' => 'required|string'
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
}
