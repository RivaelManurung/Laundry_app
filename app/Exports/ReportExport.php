<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Collection;

class ReportExport implements FromCollection, WithHeadings, WithMapping
{
    protected $transactions;
    protected $title;
    protected $period;

    public function __construct(Collection $transactions, $title, $period)
    {
        $this->transactions = $transactions;
        $this->title = $title;
        $this->period = $period;
    }

    public function collection()
    {
        return $this->transactions;
    }

    public function map($transaction): array
    {
        return [
            $transaction->created_at->format('d/m/Y H:i'),
            $transaction->invoice_code,
            $transaction->customer->name,
            $transaction->status,
            $transaction->payment_status,
            $transaction->total_amount,
        ];
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Invoice',
            'Pelanggan',
            'Status Laundry',
            'Status Pembayaran',
            'Total (Rp)',
        ];
    }
}
