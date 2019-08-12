<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Siswa_model');
        $this->load->model('Guru_model');
    }

    public function index()
    {
        $data['title'] = 'Dashboard';

        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['jumlah_siswa'] = $this->Siswa_model->hitungJumlahSiswa();
        $data['jumlah_mapel'] = $this->Siswa_model->hitungJumlahMapel();
        $data['jumlah_guru'] = $this->Siswa_model->hitungJumlahGuru();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }
}
