<?php

namespace App\Exports;

use App\Models\Pemesanan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Carbon\Carbon;

class PemesananExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths, WithMapping, WithCustomStartCell
{
    protected $startDate;
    protected $endDate;
    protected $status;

    public function __construct($startDate = null, $endDate = null, $status = 'all')
    {
        $this->startDate = $startDate instanceof Carbon ? $startDate : ($startDate ? Carbon::parse($startDate) : null);
        $this->endDate = $endDate instanceof Carbon ? $endDate : ($endDate ? Carbon::parse($endDate) : null);
        $this->status = $status;
    }

    public function collection()
    {
        $query = Pemesanan::with(['petugas'])
            ->when($this->startDate && $this->endDate, function ($query) {
                return $query->whereBetween('tanggal_pemesanan', [
                    $this->startDate->startOfDay(),
                    $this->endDate->endOfDay()
                ]);
            })
            ->when($this->status !== 'all', function ($query) {
                return $query->where('status_pembayaran', $this->status);
            })
            ->orderBy('tanggal_pemesanan', 'desc');

        return $query->get();
    }

    public function startCell(): string
    {
        return 'A6';
    }

    public function headings(): array
    {
        return [
            'No.',
            'Kode Pemesanan',
            'Tanggal',
            'Nama Penumpang',
            'Email',
            'No. Telepon',
            'Total Bayar',
            'Status',
            'Diverifikasi Oleh',
            'Tanggal Verifikasi'
        ];
    }

    public function map($pemesanan): array
    {
        static $no = 0;
        $no++;

        return [
            $no,
            $pemesanan->kode_pemesanan,
            Carbon::parse($pemesanan->tanggal_pemesanan)->format('d/m/Y H:i'),
            $pemesanan->nama_penumpang,
            $pemesanan->email,
            $pemesanan->nomor_telepon,
            'Rp ' . number_format($pemesanan->total_bayar, 0, ',', '.'),
            $this->getStatusLabel($pemesanan->status_pembayaran),
            $pemesanan->petugas ? $pemesanan->petugas->name : '-',
            $pemesanan->petugas ? Carbon::parse($pemesanan->updated_at)->format('d/m/Y H:i') : '-'
        ];
    }

    private function getStatusLabel($status)
    {
        return match ($status) {
            'PAID' => 'Lunas',
            'WAITING_CONFIRMATION' => 'Menunggu Konfirmasi',
            'PENDING' => 'Pending',
            default => $status,
        };
    }

    public function styles(Worksheet $sheet)
    {
        // Judul Laporan
        $sheet->mergeCells('A1:J1');
        $sheet->setCellValue('A1', 'LAPORAN PEMESANAN TIKET PESAWAT');
        $sheet->getStyle('A1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 16,
                'color' => ['rgb' => '000000']
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4472C4']
            ],
            'font' => [
                'color' => ['rgb' => 'FFFFFF']
            ]
        ]);

        // Informasi Periode
        $sheet->mergeCells('A3:J3');
        $periodText = 'Periode: ';
        if ($this->startDate && $this->endDate) {
            $periodText .= Carbon::parse($this->startDate)->format('d/m/Y') . ' - ' . 
                          Carbon::parse($this->endDate)->format('d/m/Y');
        } else {
            $periodText .= 'Semua Waktu';
        }
        $sheet->setCellValue('A3', $periodText);
        $sheet->getStyle('A3')->applyFromArray([
            'font' => ['bold' => true]
        ]);

        // Informasi Filter Status
        $sheet->mergeCells('A4:J4');
        $statusText = 'Status: ' . ($this->status === 'all' ? 'Semua Status' : $this->getStatusLabel($this->status));
        $sheet->setCellValue('A4', $statusText);
        $sheet->getStyle('A4')->applyFromArray([
            'font' => ['bold' => true]
        ]);

        // Header Tabel
        $headerRange = 'A6:J6';
        $sheet->getStyle($headerRange)->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF']
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4472C4']
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER
            ]
        ]);

        // Styling untuk seluruh data
        $dataRange = 'A7:J' . ($sheet->getHighestRow());
        $sheet->getStyle($dataRange)->applyFromArray([
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000']
                ]
            ]
        ]);

        // Zebra striping
        $lastRow = $sheet->getHighestRow();
        for ($row = 7; $row <= $lastRow; $row++) {
            if ($row % 2 == 0) {
                $sheet->getStyle('A'.$row.':J'.$row)->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'F5F5F5']
                    ]
                ]);
            }
        }

        // Footer
        $footerRow = $lastRow + 2;
        $sheet->mergeCells('A'.$footerRow.':J'.$footerRow);
        $sheet->setCellValue('A'.$footerRow, 'Dicetak pada: ' . now()->format('d/m/Y H:i:s'));
        $sheet->getStyle('A'.$footerRow)->applyFromArray([
            'font' => ['italic' => true],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_RIGHT]
        ]);

        // Auto-fit columns
        foreach(range('A','J') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        return $sheet;
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,     // No
            'B' => 15,    // Kode Pemesanan
            'C' => 20,    // Tanggal
            'D' => 30,    // Nama Penumpang
            'E' => 30,    // Email
            'F' => 15,    // No. Telepon
            'G' => 15,    // Total Bayar
            'H' => 20,    // Status
            'I' => 20,    // Diverifikasi Oleh
            'J' => 20,    // Tanggal Verifikasi
        ];
    }
} 