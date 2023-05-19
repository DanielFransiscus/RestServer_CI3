<?php

class User_model extends CI_Model
{
  private $_table = "users";

  public function register($username, $password)
  {
    $data = [
      'username' => $username,
      'password' => password_hash($password, PASSWORD_DEFAULT)
    ];

    $this->db->insert($this->_table, $data);
    return $this->db->insert_id();
  }

  public function login($username, $password)
  {
    $user = $this->db->get_where($this->_table, ['username' => $username])->row_array();

    if ($user && password_verify($password, $user['password'])) {
      return $user;
    }

    return false;
  }
}
