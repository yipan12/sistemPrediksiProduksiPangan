<?php
namespace App\Exports;

use App\Models\ProduksiPangan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ProduksiPanganExport implements 
    FromCollection, 
    WithMapping, 
    WithDrawings, 
    WithEvents, 
    WithCustomStartCell
{
    public function collection()
    {
        return ProduksiPangan::where('user_id', Auth::id())->get();
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('Sistem Prediksi Produksi Pangan');
        $drawing->setPath(public_path('/asset/logoSistemPrediksi.png'));
        $drawing->setHeight(60);
        $drawing->setCoordinates('A1');
        $drawing->setOffsetX(10);
        $drawing->setOffsetY(5);
        return $drawing;
    }

    public function startCell(): string
    {
        return 'A7'; // Data dimulai dari baris ke-7
    }

    public function map($row): array
    {
        return [
            $row->id,
            ucfirst(strtolower($row->produk)),
            $row->jumlah . ' kg',
            $row->harga,
            Carbon::parse($row->tanggal_produksi)->format('d-m-Y'),
            Carbon::parse($row->created_at)->format('d-m-Y H:i'),
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                $sheet->getRowDimension(1)->setRowHeight(60);
                $sheet->getRowDimension(2)->setRowHeight(25);
                $sheet->getRowDimension(3)->setRowHeight(20);
                $sheet->getRowDimension(4)->setRowHeight(10);

                // Judul
                $sheet->mergeCells('B2:F2');
                $sheet->setCellValue('B2', 'LAPORAN PRODUKSI PANGAN');
                $sheet->getStyle('B2')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 14],
                    'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
                ]);

                // Tanggal Cetak
                $sheet->mergeCells('B3:F3');
                $sheet->setCellValue('B3', 'Tanggal Cetak: ' . Carbon::now()->format('d-m-Y H:i'));
                $sheet->getStyle('B3')->applyFromArray([
                    'font' => ['size' => 10],
                    'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
                ]);

                // Header tabel manual di baris 6
                $headers = ['ID', 'Nama Produk', 'Jumlah', 'Harga', 'Tanggal Produksi', 'Created At'];
                $col = 'A';
                foreach ($headers as $header) {
                    $sheet->setCellValue($col . '6', $header);
                    $col++;
                }

                // Style header
                $sheet->getStyle('A6:F6')->applyFromArray([
                    'font' => ['bold' => true],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['argb' => 'FFCCCCCC'],
                    ],
                    'borders' => [
                        'allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                    ],
                    'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
                ]);

                foreach (range('A', 'F') as $column) {
                    $sheet->getColumnDimension($column)->setAutoSize(true);
                }

                $lastRow = $sheet->getHighestRow();
                $sheet->getStyle('A6:F' . $lastRow)->applyFromArray([
                    'borders' => [
                        'allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                    ],
                ]);
            },
        ];
    }
}
