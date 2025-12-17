<?php

namespace App\Exports;

use App\Models\ProductService;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class ServiceExport implements FromView, ShouldAutoSize, WithEvents
{
    protected $category;
    protected $typeFilter;

    public function __construct(string $category, ?string $typeFilter = null)
    {
        $this->category   = $category;
        $this->typeFilter = $typeFilter;
    }

    public function view(): View
    {
        $query = ProductService::where('category', $this->category)
            ->with(['serials', 'usedSpareParts']);

        if ($this->typeFilter) {
            $query->where('type_service', $this->typeFilter);
        }

        $services = $query->orderBy('date', 'desc')->get();

        return view('admin.exports.service', [
            'services'   => $services,
            'category'   => $this->category,
            'typeFilter' => $this->typeFilter,
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet     = $event->sheet->getDelegate();
                $highestRow = $sheet->getHighestRow();

                $linkStyle = [
                    'font' => [
                        'color'     => ['rgb' => '0000FF'],
                        'underline' => true,
                    ],
                ];

                $sheet->getStyle("M2:M{$highestRow}")->applyFromArray($linkStyle);
                $sheet->getStyle("Q2:Q{$highestRow}")->applyFromArray($linkStyle);
            },
        ];
    }
}
