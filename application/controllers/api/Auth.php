<?php
defined('BASEPATH') or exit('No direct script access allowed');


use chriskacerguis\RestServer\RestController;

date_default_timezone_set('Asia/Jakarta');


class Auth extends RestController
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('user_model');
    $this->load->library('form_validation');
  }

  public function register_post()
  {
    // Validasi data yang diterima dari klien
    $this->form_validation->set_rules('username', 'Username', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required');

    if ($this->form_validation->run() === FALSE) {
      $this->response(['message' => validation_errors()], REST_Controller::HTTP_BAD_REQUEST);
    } else {
      $username = $this->input->post('username');
      $password = $this->input->post('password');

      // Panggil model untuk menyimpan data pengguna baru ke database
      $user_id = $this->user_model->register($username, $password);

      if ($user_id) {
        $this->response(['message' => 'Registration successful'], REST_Controller::HTTP_OK);
      } else {
        $this->response(['message' => 'Registration failed'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }
    }
  }

  public function login_post()
  {
    // Validasi data yang diterima dari klien
    $this->form_validation->set_rules('username', 'Username', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required');

    if ($this->form_validation->run() === FALSE) {
      $this->response(['message' => validation_errors()], REST_Controller::HTTP_BAD_REQUEST);
    } else {
      $username = $this->input->post('username');
      $password = $this->input->post('password');

      // Panggil model untuk memeriksa keberadaan pengguna dan validitas password
      $user = $this->user_model->login($username, $password);

      if ($user) {
        // Buat token JWT
        $token = AUTHORIZATION::generateToken(['user_id' => $user['id']]);

        // Kirim token sebagai respons ke klien
        $this->response(['token' => $token], REST_Controller::HTTP_OK);
      } else {
        $this->response(['message' => 'Invalid username or password'], REST_Controller::HTTP_UNAUTHORIZED);
      }
    }
  }

  public function logout_post()
  {
    // Logout hanya membutuhkan validasi token yang dilakukan di middleware
    // Jadi di sini Anda tidak perlu menulis kode apa pun
    $this->response(['message' => 'Logout successful'], REST_Controller::HTTP_OK);
  }
}
