<?php

class Guru_model extends CI_Model
{
    public function getAllGuru()
    {
        return $this->db->get('user')->result_array();
    }

    public function getGuruById($id)
    {
        return $this->db->get_where('user', ['id' => $id])->row_array();
    }

    public function hapusDataGuru($id)
    {
        $this->db->delete('user', ['id' => $id]);
    }

    public function tambahDataUser()
    {
        $data = [
            'nip' => htmlspecialchars($this->input->post('nip', true)),
            'nama' => htmlspecialchars($this->input->post('nama', true)),
            'email' => htmlspecialchars($this->input->post('email', true)),
            'username' => htmlspecialchars($this->input->post('username', true)),
            'jenis_kelamin' => htmlspecialchars($this->input->post('jenis_kelamin', true)),
            'telp' => htmlspecialchars($this->input->post('telp', true)),
            'alamat' => htmlspecialchars($this->input->post('alamat', true)),
            'tgl_lahir' => htmlspecialchars($this->input->post('tgl_lahir', true)),
            'image' => 'default.jpg',
            'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT,),
            'is_active' => 1,
            'date_created' => time()
        ];

        $this->db->insert('user', $data);
    }

    public function ubahDataGuru()
    {
        $data = [
            'nip' => htmlspecialchars($this->input->post('nip', true)),
            'nama' => htmlspecialchars($this->input->post('nama', true)),
            'email' => htmlspecialchars($this->input->post('email', true)),
            'username' => htmlspecialchars($this->input->post('username', true)),
            'jenis_kelamin' => htmlspecialchars($this->input->post('jenis_kelamin', true)),
            'telp' => htmlspecialchars($this->input->post('telp', true)),
            'alamat' => htmlspecialchars($this->input->post('alamat', true)),
            'tgl_lahir' => htmlspecialchars($this->input->post('tgl_lahir', true)),
            'image' => 'default.jpg',
            'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
            'role_id' => 2,
            'is_active' => 1,
            'date_created' => time()
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('user', $data);
    }
}
