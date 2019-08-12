<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Siswa_model');
        $this->load->model('Guru_model');
    }
    public function siswa()
    {
        $data['title'] = 'Daftar Siswa';

        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $data['siswa'] = $this->db->get('siswa')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('siswa/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambahDataSiswa()
    {
        $data['title'] = 'Tambah Siswa';

        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $data['siswa'] = $this->Siswa_model->getAllSiswa();

        // set rules
        $this->form_validation->set_rules('nis', 'Nis', 'required|trim|numeric|max_length[10]|is_unique[user.nip]', [
            'required' => 'Nis harus diisi!',
            'numeric' => 'Harus berupa angka.'
        ]);
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
            'required' => 'Nama harus diisi!'
        ]);
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required|trim', [
            'required' => 'Jenis Kelamin harus diisi!'
        ]);
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|trim', [
            'required' => 'Tanggal lahir harus diisi!'
        ]);
        $this->form_validation->set_rules('telp', 'No Telp', 'required|trim|numeric|max_length[12]|is_unique[user.telp]', [
            'required' => 'No. Telephone harus diisi!'
        ]);
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', [
            'required' => 'Alamat harus diisi!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('siswa/tambah_siswa_view', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Siswa_model->tambahSiswa();

            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Data siswa baru ditambahkan.</div>');
            redirect('data/siswa');
        }
    }

    public function hapusSiswa($id)
    {
        $this->Siswa_model->hapusDataSiswa($id);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
        Data siswa berhasil di hapus.</div>');
        redirect('data/siswa');
    }



    public function guru()
    {
        $data['title'] = 'Daftar Guru';

        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $data['guru'] = $this->Guru_model->getAllGuru();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('guru/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambahUser()
    {
        $data['title'] = 'Tambah Data Guru';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['guru'] = $this->db->get('user')->result_array();

        // set rules
        $this->form_validation->set_rules('nip', 'Nip', 'required|trim|numeric|max_length[5]|is_unique[user.nip]', [
            'required' => 'Nip harus diisi!',
            'numeric' => 'Harus berupa angka.'
        ]);
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
            'required' => 'Nama harus diisi!'
        ]);
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]', [
            'required' => 'Username harus diisi!',
            'is_unique' => 'Username sudah terdaftar'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'required' => 'Email harus diisi!',
            'valid_email' => 'Harus berupa email',
            'is_unique' => 'Email sudah terdaftar'
        ]);
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required|trim', [
            'required' => 'Jenis Kelamin harus diisi!'
        ]);
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|trim', [
            'required' => 'Tanggal lahir harus diisi!'
        ]);
        $this->form_validation->set_rules('telp', 'No Telp', 'required|trim|numeric|max_length[12]|is_unique[user.telp]', [
            'required' => 'No. Telephone harus diisi!'
        ]);
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', [
            'required' => 'Alamat harus diisi!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'required' => 'password harus diisi!',
            'min_length' => 'Password minimal 3 karakter',
            'matches' => 'Passord tidak sama!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('guru/register', $data);
            $this->load->view('templates/footer');
        } else {

            $this->Guru_model->tambahDataUser();

            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Data guru baru ditambahkan.</div>');
            redirect('data/guru');
        }
    }

    public function hapusGuru($id)
    {
        $this->Guru_model->hapusDataGuru($id);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
        Data guru berhasil di hapus.</div>');
        redirect('data/guru');
    }

    public function mapel()
    {
        $data['title'] = 'Mata Pelajaran';

        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['mapel'] = $this->Siswa_model->getAllMapel();

        // set rules
        $this->form_validation->set_rules('mapel', 'Mata Pelajaran', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('siswa/mapel_view', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Siswa_model->tambahDataMapel();

            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Matapelajaran baru ditambahkan.</div>');
            redirect('data/mapel');
        }
    }

    public function hapusMapel($id)
    {
        $this->Siswa_model->hapusDataMapel($id);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
        Data matapelajaran berhasil di hapus.</div>');
        redirect('data/mapel');
    }

    public function editSiswa($id)
    {
        $data['title'] = 'Ubah Data Siswa';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['siswa'] = $this->Siswa_model->getSiswaById($id);
        $data['jenis_kelamin'] = ['Laki-laki', 'Perempuan'];

        // set rules
        $this->form_validation->set_rules('nis', 'Nis', 'required|trim|numeric|max_length[10]|is_unique[user.nip]', [
            'required' => 'Nis harus diisi!',
            'numeric' => 'Harus berupa angka.'
        ]);
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
            'required' => 'Nama harus diisi!'
        ]);
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required|trim', [
            'required' => 'Jenis Kelamin harus diisi!'
        ]);
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|trim', [
            'required' => 'Tanggal lahir harus diisi!'
        ]);
        $this->form_validation->set_rules('telp', 'No Telp', 'required|trim|numeric|max_length[12]|is_unique[user.telp]', [
            'required' => 'No. Telephone harus diisi!'
        ]);
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', [
            'required' => 'Alamat harus diisi!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('siswa/ubah_siswa_view', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Siswa_model->ubahDataSiswa($id);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Data nilai siswa berhasil di ubah.</div>');
            redirect('data/siswa');
        }
    }

    public function ubahMapel($id)
    {
        $data['title'] = 'Ubah Matapelajaran';

        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['siswa'] = $this->Siswa_model->getAllSiswa();
        $data['_mapel'] = $this->Siswa_model->getAllMapel();
        $data['mapel'] = $this->Siswa_model->getMapelById($id);

        $data['nilai'] = $this->Siswa_model->getAllNilai();

        // set rules
        $this->form_validation->set_rules('mapel', 'Matapelajaran', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('siswa/ubah_mapel_view', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Siswa_model->ubahDataMapel($id);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Data siswa berhasil di ubah.</div>');
            redirect('data/mapel');
        }
    }

    public function detailGuru($id)
    {
        $data['title'] = 'Detail Data Guru';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['guru'] = $this->Guru_model->getGuruById($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('guru/detail_guru_view', $data);
        $this->load->view('templates/footer');
    }

    public function editGuru($id)
    {
        $data['title'] = 'Ubah Data Siswa';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['guru'] = $this->Guru_model->getGuruById($id);
        $data['jenis_kelamin'] = ['Laki-laki', 'Perempuan'];

        // set rules
        $this->form_validation->set_rules('nip', 'Nip', 'required|trim|numeric|max_length[5]|is_unique[user.nip]', [
            'required' => 'Nip harus diisi!',
            'numeric' => 'Harus berupa angka.'
        ]);
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
            'required' => 'Nama harus diisi!'
        ]);
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]', [
            'required' => 'Username harus diisi!',
            'is_unique' => 'Username sudah terdaftar'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'required' => 'Email harus diisi!',
            'valid_email' => 'Harus berupa email',
            'is_unique' => 'Email sudah terdaftar'
        ]);
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required|trim', [
            'required' => 'Jenis Kelamin harus diisi!'
        ]);
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|trim', [
            'required' => 'Tanggal lahir harus diisi!'
        ]);
        $this->form_validation->set_rules('telp', 'No Telp', 'required|trim|numeric|max_length[12]|is_unique[user.telp]', [
            'required' => 'No. Telephone harus diisi!'
        ]);
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', [
            'required' => 'Alamat harus diisi!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('guru/ubah_guru_view', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Siswa_model->ubahDataSiswa($id);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Data guru berhasil di ubah.</div>');
            redirect('data/guru');
        }
    }
}
