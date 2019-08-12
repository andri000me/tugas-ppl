<?php
class Cetak extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('pdf');
    }

    function cetakSiswa()
    {
        $pdf = new FPDF('l', 'mm', 'A5');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial', 'B', 16);
        // mencetak string 
        $pdf->Image('assets/img/logo-udinus.png', 50, 1, 10, 10);
        $pdf->Cell(190, 7, 'SEKOLAH MENENGAH KEJURUSAN BINBAN', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(190, 7, 'DAFTAR SISWA ', 0, 1, 'C');
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(25, 6, 'NIS', 1, 0);
        $pdf->Cell(50, 6, 'NAMA SISWA', 1, 0);
        $pdf->Cell(27, 6, 'NO HP', 1, 0);
        $pdf->Cell(35, 6, 'JENIS KELAMIN', 1, 0);
        $pdf->Cell(35, 6, 'TANGGAL LAHIR', 1, 1);
        $pdf->SetFont('Arial', '', 10);
        $siswa = $this->db->get('siswa')->result();
        foreach ($siswa as $row) {
            $pdf->Cell(25, 6, $row->nis, 1, 0);
            $pdf->Cell(50, 6, $row->nama, 1, 0);
            $pdf->Cell(27, 6, $row->telp, 1, 0);
            $pdf->Cell(35, 6, $row->jenis_kelamin, 1, 0);
            $pdf->Cell(35, 6, $row->tgl_lahir, 1, 1);
        }
        $pdf->Output();
    }

    function cetakGuru()
    {
        $pdf = new FPDF('l', 'mm', 'A5');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial', 'B', 16);
        // mencetak string 
        $pdf->Image('assets/img/logo-udinus.png', 10, 10);
        $pdf->Cell(190, 7, 'SEKOLAH MENENGAH KEJURUSAN BINBAN', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(190, 7, 'DAFTAR GURU ', 0, 1, 'C');
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(25, 6, 'NIP', 1, 0);
        $pdf->Cell(45, 6, 'NAMA GURU', 1, 0);
        $pdf->Cell(30, 6, 'EMAIL', 1, 0);
        $pdf->Cell(27, 6, 'NO HP', 1, 0);
        $pdf->Cell(35, 6, 'JENIS KELAMIN', 1, 0);
        $pdf->Cell(35, 6, 'TANGGAL LAHIR', 1, 1);
        $pdf->SetFont('Arial', '', 10);
        $siswa = $this->db->get('user')->result();
        foreach ($siswa as $row) {
            $pdf->Cell(25, 6, $row->nip, 1, 0);
            $pdf->Cell(45, 6, $row->nama, 1, 0);
            $pdf->Cell(30, 6, $row->email, 1, 0);
            $pdf->Cell(27, 6, $row->telp, 1, 0);
            $pdf->Cell(35, 6, $row->jenis_kelamin, 1, 0);
            $pdf->Cell(35, 6, $row->tgl_lahir, 1, 1);
        }
        $pdf->Output();
    }

    function cetakNilai()
    {
        $pdf = new FPDF('l', 'mm', 'A5');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial', 'B', 16);
        // mencetak string 
        $pdf->Cell(190, 7, 'SEKOLAH MENENGAH KEJURUSAN BINBAN', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(190, 7, 'DAFTAR NILAI SISWA ', 0, 1, 'C');
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(50, 6, 'NAMA SISWA', 1, 0);
        $pdf->Cell(50, 6, 'MATA PELAJARAN', 1, 0);
        $pdf->Cell(35, 6, 'NILAI', 1, 1);
        $pdf->SetFont('Arial', '', 10);
        $siswa = $this->db->get('cetak_nilai')->result();
        foreach ($siswa as $row) {
            $pdf->Cell(50, 6, $row->nama, 1, 0);
            $pdf->Cell(50, 6, $row->mapel, 1, 0);
            $pdf->Cell(35, 6, $row->nilai, 1, 1);
        }
        $pdf->Output();
    }
}
