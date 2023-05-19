<?php

class Mahasiswa_model extends CI_Model
{
  private $_table = "mahasiswa";


  public function getMahasiswaWithLimit($start, $limit)
  {
    if (!is_numeric($start) || !is_numeric($limit) || $start < 0 || $limit < 0) {
      return false; // Tambahkan validasi jika nilai start atau limit tidak valid
    }

    $this->db->limit($limit, $start);
    return $this->db->get($this->_table)->result_array();
  }


  public function getTotalMahasiswa()
  {
    return $this->db->count_all($this->_table);
  }

  public function getMahasiswa($id = null)
  {
    if ($id === null) {
      return $this->db->get($this->_table)->result_array();
    } else {
      $this->db->where('id', $id);
      $result = $this->db->get($this->_table)->row_array(); // Menggunakan row_array() untuk mengambil satu baris sebagai array

      if ($result === null) {
        return false;
      }

      return $result;
    }
  }


  public function getMahasiswaById($id)
  {
    if (!is_numeric($id) || $id < 1) {
      return false; // Tambahkan validasi jika nilai id tidak valid
    }

    return $this->db->get_where($this->_table, ['id' => $id])->row();
  }

  public function deleteMahasiswa($id)
  {
    $this->db->where('id', $id);
    $mahasiswa = $this->db->get($this->_table)->row();

    if (!$mahasiswa) {
      return false; // ID tidak ditemukan
    }

    return $this->db->delete($this->_table, ['id' => $id]);
  }

  public function createMahasiswa($data)
  {
    return $this->db->insert($this->_table, $data);
  }

  public function updateMahasiswa($data, $id)
  {

    $mahasiswa = $this->db->get($this->_table)->row();

    if (!$mahasiswa) {
      return false; // ID tidak ditemukan
    }

    return $this->db->update($this->_table, $data, array('id' => $id));
  }
  public function checkImageExists($id)
  {
    $this->db->where('id', $id);
    $this->db->where('gambar IS NOT NULL');
    $query = $this->db->get('mahasiswa');
    return $query->num_rows() > 0;
  }
}
