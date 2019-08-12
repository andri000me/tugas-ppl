<?php

class Siswa_model extends CI_Model
{
    public function getAllSiswa()
    {
        return $this->db->get('siswa')->result_array();
    }

    public function hapusDataSiswa($id)
    {
        $this->db->delete('siswa', ['id' => $id]);
    }

    public function getSiswaById($id)
    {
        return $this->db->get_where('siswa', ['id' => $id])->row_array();
    }

    public function tambahSiswa()
    {
        $data = [
            'nis' => htmlspecialchars($this->input->post('nis', true)),
            'nama' => htmlspecialchars($this->input->post('nama', true)),
            'jenis_kelamin' => htmlspecialchars($this->input->post('jenis_kelamin', true)),
            'tgl_lahir' => htmlspecialchars($this->input->post('tgl_lahir', true)),
            'telp' => htmlspecialchars($this->input->post('telp', true)),
            'alamat' => htmlspecialchars($this->input->post('alamat', true)),
            'image' => 'default.jpg',
            'is_active' => 1,
            'date_created' => time()
        ];

        $this->db->insert('siswa', $data);
    }

    public function ubahDataSiswa()
    {
        $data = [
            'nis' => htmlspecialchars($this->input->post('nis', true)),
            'nama' => htmlspecialchars($this->input->post('nama', true)),
            'jenis_kelamin' => htmlspecialchars($this->input->post('jenis_kelamin', true)),
            'tgl_lahir' => htmlspecialchars($this->input->post('tgl_lahir', true)),
            'telp' => htmlspecialchars($this->input->post('telp', true)),
            'alamat' => htmlspecialchars($this->input->post('alamat', true)),
            'image' => 'default.jpg',
            'is_active' => 1,
            'date_created' => time()
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('siswa', $data);
    }

    public function getAllNilai()
    {
        return $this->db->get('nilai')->result_array();
    }

    public function getAllDataNilai()
    {
        return $this->db->get('cetak_nilai')->result_array();
    }

    public function getNilaiById($id)
    {
        return $this->db->get_where('cetak_nilai', ['id' => $id])->row_array();
    }

    public function getMapelById($id)
    {
        return $this->db->get_where('mata_pelajaran', ['id' => $id])->row_array();
    }

    public function getAllMapel()
    {
        return $this->db->get('mata_pelajaran')->result_array();
    }

    public function tambahDataNilai()
    {
        $data = [
            'nama' => htmlspecialchars($this->input->post('nama', true)),
            'mapel' => htmlspecialchars($this->input->post('mapel', true)),
            'nilai' => htmlspecialchars($this->input->post('nilai', true)),

        ];

        $this->db->insert('cetak_nilai', $data);
    }

    public function tambahDataMapel()
    {
        $data = [
            'mapel' => htmlspecialchars($this->input->post('mapel', true))

        ];

        $this->db->insert('mata_pelajaran', $data);
    }

    public function hapusDataNilaiSiswa($id)
    {
        $this->db->delete('cetak_nilai', ['id' => $id]);
    }

    public function hapusDataMapel($id)
    {
        $this->db->delete('mata_pelajaran', ['id' => $id]);
    }

    public function ubahDataNilaiSiswa()
    {
        $data = [
            'nama' => htmlspecialchars($this->input->post('nama', true)),
            'mapel' => htmlspecialchars($this->input->post('mapel', true)),
            'nilai' => htmlspecialchars($this->input->post('nilai', true)),

        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('cetak_nilai', $data);
    }

    public function ubahDataMapel()
    {
        $data = [
            'mapel' => htmlspecialchars($this->input->post('mapel', true))

        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('mata_pelajaran', $data);
    }

    public function hitungJumlahSiswa()
    {
        $query = $this->db->get('siswa');
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }

    public function hitungJumlahMapel()
    {
        $query = $this->db->get('mata_pelajaran');
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }

    public function hitungJumlahGuru()
    {
        $query = $this->db->get('user');
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }
}
