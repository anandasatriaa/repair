<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductService;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Ambil semua kategori unik dari database
        $categories = ProductService::select('category')->distinct()->pluck('category')->toArray();

        // Total keseluruhan
        $totalAll = ProductService::count();

        // Total berdasarkan kategori
        $byCategoryAll = ProductService::select('category', DB::raw('count(*) as total'))
            ->groupBy('category')
            ->pluck('total', 'category')
            ->toArray();

        // Total ON PROGRESS
        $totalOnProg = ProductService::where('status', 'ON PROGRESS')->count();
        $byCategoryOn = ProductService::where('status', 'ON PROGRESS')
            ->select('category', DB::raw('count(*) as total'))
            ->groupBy('category')
            ->pluck('total', 'category')
            ->toArray();

        // Total DONE
        $totalDone = ProductService::where('status', 'DONE')->count();
        $byCategoryDone = ProductService::where('status', 'DONE')
            ->select('category', DB::raw('count(*) as total'))
            ->groupBy('category')
            ->pluck('total', 'category')
            ->toArray();

        // Data untuk chart kategori
        $chartCatLabels = array_keys($byCategoryAll);
        $chartCatData   = array_values($byCategoryAll);

        // Data untuk chart tipe service
        $byTypeService = ProductService::select('type_service', DB::raw('count(*) as total'))
            ->whereNotNull('type_service')
            ->groupBy('type_service')
            ->pluck('total', 'type_service')
            ->toArray();

        $chartTypeLabels = array_keys($byTypeService);
        $chartTypeData   = array_values($byTypeService);

        return view('admin.dashboard', compact(
            'categories',
            'totalAll',
            'totalOnProg',
            'totalDone',
            'byCategoryAll',
            'byCategoryOn',
            'byCategoryDone',
            'chartCatLabels',
            'chartCatData',
            'chartTypeLabels',
            'chartTypeData'
        ));
    }
}
