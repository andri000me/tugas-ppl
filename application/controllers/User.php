<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Siswa_model');
        $this->load->model('Guru_model');
    }

    public function index()
    {
        $data['title'] = 'Profile';

        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }

    public function changePassword()
    {
        $data['title'] = 'Change Password';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[3]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[3]|matches[new_password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/changepassword', $data);
            $this->load->view('templates/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong current password!</div>');
                redirect('user/changepassword');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">New password cannot be the same as current password!</div>');
                    redirect('user/changepassword');
                } else {
                    // password sudah ok
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('username', $this->session->userdata('username'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password changed!</div>');
                    redirect('user/changepassword');
                }
            }
        }
    }

    public function cetakSiswa()
    {
        $data['title'] = 'Daftar Siswa';

        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['siswa'] = $this->db->get('siswa')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('siswa/cetak_siswa_view', $data);
        $this->load->view('templates/footer');
    }

    public function cetakGuru()
    {
        $data['title'] = 'Daftar Guru';

        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['guru'] = $this->db->get('user')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('guru/cetak_guru_view', $data);
        $this->load->view('templates/footer');
    }

    public function nilaiSiswa()
    {
        $data['title'] = 'Nilai Siswa';

        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['siswa'] = $this->Siswa_model->getAllSiswa();
        $data['mapel'] = $this->Siswa_model->getAllMapel();
        $data['cetak_nilai'] = $this->Siswa_model->getAllDataNilai();

        $data['nilai'] = $this->Siswa_model->getAllNilai();

        // set rules
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('mapel', 'Mata Pelajaran', 'required');
        $this->form_validation->set_rules('nilai', 'Nilai', 'required');




        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('siswa/cetak_nilai_view', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Siswa_model->tambahDataNilai();

            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            NIlai siswa baru ditambahkan.</div>');
            redirect('user/nilaiSiswa');
        }
    }

    public function hapusDataNilai($id)
    {
        $this->Siswa_model->hapusDataNilaiSiswa($id);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
        Data nilai siswa berhasil di hapus.</div>');
        redirect('user/nilaiSiswa');
    }

    public function ubahDataNilai($id)
    {
        $data['title'] = 'Nilai Siswa';

        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['siswa'] = $this->Siswa_model->getAllSiswa();
        $data['mapel'] = $this->Siswa_model->getAllMapel();
        $data['cetak_nilai'] = $this->Siswa_model->getNilaiById($id);

        $data['nilai'] = $this->Siswa_model->getAllNilai();

        // set rules
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('mapel', 'Mata Pelajaran', 'required');
        $this->form_validation->set_rules('nilai', 'Nilai', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('siswa/ubah_nilai_view', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Siswa_model->ubahDataNilaiSiswa($id);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Data nilai siswa berhasil di ubah.</div>');
            redirect('user/nilaiSiswa');
        }
    }

    public function editUser($id)
    {
        $data['title'] = 'Ubah Data Guru';
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
            redirect('user');
        }
    }
}
