<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductService;
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
            'field' => 'required|in:type_service,status,actual_problem',
            'value' => 'required|string'
        ]);

        $service = ProductService::findOrFail($request->id);
        $service->{$request->field} = $request->value;
        $service->save();

        return response()->json(['success' => true]);
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
