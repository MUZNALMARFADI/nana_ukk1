<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

class LaporanController extends Controller
{
    // Halaman utama laporan
    public function index()
    {
        return view('laporan.index');
    }

    // ==================== LAPORAN PEMBAYARAN ====================
    public function pembayaran(Request $request)
    {
        $query = Pembayaran::with(['siswa.kelas', 'petugas', 'spp']);

        // Filter berdasarkan bulan
        if ($request->bulan) {
            $query->where('bulan_dibayar', $request->bulan);
        }

        // Filter berdasarkan tahun
        if ($request->tahun) {
            $query->where('tahun_dibayar', $request->tahun);
        }

        // Filter berdasarkan kelas
        if ($request->kelas) {
            $query->whereHas('siswa', function($q) use ($request) {
                $q->where('id_kelas', $request->kelas);
            });
        }

        $pembayaran = $query->orderBy('tgl_bayar', 'desc')->get();
        $totalPembayaran = $pembayaran->sum('jumlah_bayar');

        $kelas = Kelas::orderBy('nama_kelas')->get();
        $bulan = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        // Export ke Excel
        if ($request->has('export')) {
            return $this->exportPembayaranExcel($pembayaran, $request);
        }

        return view('laporan.pembayaran', compact('pembayaran', 'totalPembayaran', 'kelas', 'bulan'));
    }

    // Export Pembayaran ke Excel
    private function exportPembayaranExcel($pembayaran, $request)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header
        $sheet->setCellValue('A1', 'LAPORAN PEMBAYARAN SPP');
        $sheet->mergeCells('A1:I1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Info Filter
        $row = 2;
        if ($request->bulan) {
            $sheet->setCellValue('A'.$row, 'Bulan: ' . $request->bulan);
            $row++;
        }
        if ($request->tahun) {
            $sheet->setCellValue('A'.$row, 'Tahun: ' . $request->tahun);
            $row++;
        }
        if ($request->kelas) {
            $kelas = Kelas::find($request->kelas);
            $sheet->setCellValue('A'.$row, 'Kelas: ' . $kelas->nama_kelas);
            $row++;
        }
        $row++;

        // Header Tabel
        $headerRow = $row;
        $headers = ['No', 'NIS', 'Nama Siswa', 'Kelas', 'Bulan', 'Tahun', 'Nominal', 'Tanggal Bayar', 'Petugas'];
        $col = 'A';
        foreach ($headers as $header) {
            $sheet->setCellValue($col.$headerRow, $header);
            $sheet->getStyle($col.$headerRow)->getFont()->setBold(true);
            $sheet->getStyle($col.$headerRow)->getFill()
                ->setFillType(Fill::FILL_SOLID)
                ->getStartColor()->setARGB('FF52be80');
            $sheet->getStyle($col.$headerRow)->getFont()->getColor()->setARGB('FFFFFFFF');
            $col++;
        }

        // Data
        $row++;
        $no = 1;
        foreach ($pembayaran as $item) {
            $sheet->setCellValue('A'.$row, $no++);
            $sheet->setCellValue('B'.$row, $item->nisn);
            $sheet->setCellValue('C'.$row, $item->siswa->nama ?? '-');
            $sheet->setCellValue('D'.$row, $item->siswa->kelas->nama_kelas ?? '-');
            $sheet->setCellValue('E'.$row, $item->bulan_dibayar);
            $sheet->setCellValue('F'.$row, $item->tahun_dibayar);
            $sheet->setCellValue('G'.$row, $item->jumlah_bayar);
            $sheet->setCellValue('H'.$row, $item->tgl_bayar->format('d/m/Y'));
            $sheet->setCellValue('I'.$row, $item->petugas->nama_petugas ?? '-');
            $row++;
        }

        // Total
        $sheet->setCellValue('F'.$row, 'TOTAL:');
        $sheet->setCellValue('G'.$row, $pembayaran->sum('jumlah_bayar'));
        $sheet->getStyle('F'.$row.':G'.$row)->getFont()->setBold(true);

        // Styling
        $sheet->getStyle('A'.$headerRow.':I'.($row))->getBorders()->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);
        $sheet->getStyle('G'.($headerRow+1).':G'.$row)->getNumberFormat()
            ->setFormatCode('#,##0');

        // Auto size
        foreach (range('A', 'I') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Download
        $writer = new Xlsx($spreadsheet);
        $filename = 'Laporan_Pembayaran_' . date('Y-m-d_His') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }

    // ==================== LAPORAN TUNGGAKAN ====================
    public function tunggakan(Request $request)
    {
        $tahun = $request->tahun ?? date('Y');
        $filterKelas = $request->kelas;
        
        $siswaQuery = Siswa::with(['kelas', 'spp', 'pembayaran' => function($q) use ($tahun) {
            $q->where('tahun_dibayar', $tahun);
        }]);

        if ($filterKelas) {
            $siswaQuery->where('id_kelas', $filterKelas);
        }

        $siswa = $siswaQuery->get();

        $dataTunggakan = [];
        $bulanList = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        foreach ($siswa as $s) {
            $bulanDibayar = $s->pembayaran->pluck('bulan_dibayar')->toArray();
            $bulanBelumBayar = array_diff($bulanList, $bulanDibayar);

            if (count($bulanBelumBayar) > 0) {
                $dataTunggakan[] = [
                    'siswa' => $s,
                    'bulan_belum_bayar' => $bulanBelumBayar,
                    'jumlah_tunggakan' => count($bulanBelumBayar) * ($s->spp->nominal ?? 0)
                ];
            }
        }

        $kelas = Kelas::orderBy('nama_kelas')->get();

        // Export Excel
        if ($request->has('export')) {
            return $this->exportTunggakanExcel($dataTunggakan, $tahun);
        }

        return view('laporan.tunggakan', compact('dataTunggakan', 'tahun', 'kelas'));
    }

    // Export Tunggakan ke Excel
    private function exportTunggakanExcel($dataTunggakan, $tahun)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header
        $sheet->setCellValue('A1', 'LAPORAN TUNGGAKAN SPP TAHUN ' . $tahun);
        $sheet->mergeCells('A1:F1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Header Tabel
        $headers = ['No', 'NIS', 'Nama Siswa', 'Kelas', 'Bulan Tunggakan', 'Total Tunggakan'];
        $col = 'A';
        foreach ($headers as $header) {
            $sheet->setCellValue($col.'3', $header);
            $sheet->getStyle($col.'3')->getFont()->setBold(true);
            $sheet->getStyle($col.'3')->getFill()
                ->setFillType(Fill::FILL_SOLID)
                ->getStartColor()->setARGB('FFe74c3c');
            $sheet->getStyle($col.'3')->getFont()->getColor()->setARGB('FFFFFFFF');
            $col++;
        }

        // Data
        $row = 4;
        $no = 1;
        $grandTotal = 0;
        foreach ($dataTunggakan as $item) {
            $sheet->setCellValue('A'.$row, $no++);
            $sheet->setCellValue('B'.$row, $item['siswa']->nisn);
            $sheet->setCellValue('C'.$row, $item['siswa']->nama);
            $sheet->setCellValue('D'.$row, $item['siswa']->kelas->nama_kelas ?? '-');
            $sheet->setCellValue('E'.$row, implode(', ', $item['bulan_belum_bayar']));
            $sheet->setCellValue('F'.$row, $item['jumlah_tunggakan']);
            $grandTotal += $item['jumlah_tunggakan'];
            $row++;
        }

        // Grand Total
        $sheet->setCellValue('E'.$row, 'GRAND TOTAL:');
        $sheet->setCellValue('F'.$row, $grandTotal);
        $sheet->getStyle('E'.$row.':F'.$row)->getFont()->setBold(true);

        // Styling
        $sheet->getStyle('A3:F'.($row))->getBorders()->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);
        $sheet->getStyle('F4:F'.$row)->getNumberFormat()
            ->setFormatCode('#,##0');

        // Auto size
        foreach (range('A', 'F') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Download
        $writer = new Xlsx($spreadsheet);
        $filename = 'Laporan_Tunggakan_' . $tahun . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }

    // ==================== LAPORAN PER KELAS ====================
    public function perKelas(Request $request)
    {
        $tahun = $request->tahun ?? date('Y');
        $kelasId = $request->kelas_id;

        $kelasQuery = Kelas::with(['siswa.pembayaran' => function($q) use ($tahun) {
            $q->where('tahun_dibayar', $tahun);
        }]);

        if ($kelasId) {
            $kelasQuery->where('id_kelas', $kelasId);
        }

        $kelas = $kelasQuery->get();

        $dataKelas = [];
        foreach ($kelas as $k) {
            $totalSiswa = $k->siswa->count();
            $totalPembayaran = 0;
            $siswaSudahBayar = 0;

            foreach ($k->siswa as $siswa) {
                $totalPembayaran += $siswa->pembayaran->sum('jumlah_bayar');
                if ($siswa->pembayaran->count() > 0) {
                    $siswaSudahBayar++;
                }
            }

            $dataKelas[] = [
                'kelas' => $k,
                'total_siswa' => $totalSiswa,
                'total_pembayaran' => $totalPembayaran,
                'siswa_sudah_bayar' => $siswaSudahBayar,
                'siswa_belum_bayar' => $totalSiswa - $siswaSudahBayar
            ];
        }

        $allKelas = Kelas::orderBy('nama_kelas')->get();

        // Export Excel
        if ($request->has('export')) {
            return $this->exportPerKelasExcel($dataKelas, $tahun);
        }

        return view('laporan.per-kelas', compact('dataKelas', 'allKelas', 'tahun'));
    }

    // Export Per Kelas ke Excel
    private function exportPerKelasExcel($dataKelas, $tahun)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header
        $sheet->setCellValue('A1', 'LAPORAN PEMBAYARAN PER KELAS TAHUN ' . $tahun);
        $sheet->mergeCells('A1:F1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Header Tabel
        $headers = ['No', 'Kelas', 'Jumlah Siswa', 'Total Pembayaran', 'Sudah Bayar', 'Belum Bayar'];
        $col = 'A';
        foreach ($headers as $header) {
            $sheet->setCellValue($col.'3', $header);
            $sheet->getStyle($col.'3')->getFont()->setBold(true);
            $sheet->getStyle($col.'3')->getFill()
                ->setFillType(Fill::FILL_SOLID)
                ->getStartColor()->setARGB('FF3498db');
            $sheet->getStyle($col.'3')->getFont()->getColor()->setARGB('FFFFFFFF');
            $col++;
        }

        // Data
        $row = 4;
        $no = 1;
        $grandTotal = 0;
        foreach ($dataKelas as $item) {
            $sheet->setCellValue('A'.$row, $no++);
            $sheet->setCellValue('B'.$row, $item['kelas']->nama_kelas);
            $sheet->setCellValue('C'.$row, $item['total_siswa']);
            $sheet->setCellValue('D'.$row, $item['total_pembayaran']);
            $sheet->setCellValue('E'.$row, $item['siswa_sudah_bayar']);
            $sheet->setCellValue('F'.$row, $item['siswa_belum_bayar']);
            $grandTotal += $item['total_pembayaran'];
            $row++;
        }

        // Grand Total
        $sheet->setCellValue('C'.$row, 'GRAND TOTAL:');
        $sheet->setCellValue('D'.$row, $grandTotal);
        $sheet->getStyle('C'.$row.':D'.$row)->getFont()->setBold(true);

        // Styling
        $sheet->getStyle('A3:F'.($row))->getBorders()->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);
        $sheet->getStyle('D4:D'.$row)->getNumberFormat()
            ->setFormatCode('#,##0');

        // Auto size
        foreach (range('A', 'F') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Download
        $writer = new Xlsx($spreadsheet);
        $filename = 'Laporan_Per_Kelas_' . $tahun . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }
}