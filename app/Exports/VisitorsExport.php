<?php

namespace App\Exports;

use App\Models\Visitor;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class VisitorsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        return Visitor::whereBetween('visit_date', [$this->startDate, $this->endDate])
            ->orderBy('visit_date', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'IP Address',
            'Tanggal Kunjungan',
            'Jumlah Views',
            'Browser / User Agent',
            'Ditambahkan Pada',
            'Diperbarui Pada',
        ];
    }

    public function map($visitor): array
    {
        return [
            $visitor->id,
            $visitor->ip_address,
            $visitor->visit_date,
            $visitor->hits,
            $visitor->user_agent,
            $visitor->created_at->format('Y-m-d H:i:s'),
            $visitor->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
