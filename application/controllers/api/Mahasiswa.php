<?php
defined('BASEPATH') or exit('No direct script access allowed');


use chriskacerguis\RestServer\RestController;

date_default_timezone_set('Asia/Jakarta');
class Mahasiswa extends RestController
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Mahasiswa_model', 'mahasiswa');
    $this->methods['index_get']['limit'] = 10000;
    date_default_timezone_set('Asia/Jakarta');
    //limit hit ap i
  }

  public function rules()
  {
    $rules = [
      [
        'field' => 'nama',
        'label' => 'Nama',
        'rules' => 'required|max_length[250]|regex_match[/^[a-zA-Z\s]+$/]'
      ],
      [
        'field' => 'email',
        'label' => 'Email',
        'rules' => 'required|valid_email|max_length[250]'
      ],
      [
        'field' => 'jurusan',
        'label' => 'Jurusan',
        'rules' => 'required|max_length[64]|regex_match[/^[a-zA-Z\s]+$/]'
      ],
      [
        'field' => 'gambar',
        'label' => 'Gambar',
        'rules' => 'max_length[225]'
      ]
    ];
    return $rules;
  }



  public function index_get($id = null)
  {
    $id = $this->uri->segment(3); // Get ID from URI
    $page = $this->input->get('page');
    $limit = 5; // Set a valid default value here
    $response = [];

    // Validate page value
    if ($page !== null && (!ctype_digit($page) || $page < 1)) {
      $response = [
        'code' => 400,
        'status' => 'Bad Request',
        'message' => 'Invalid page value. Page must be a positive number.',
      ];
    } else {
      $totalRows = $this->mahasiswa->getTotalMahasiswa();
      $totalPages = ceil($totalRows / $limit);

      if (!empty($id) && !ctype_digit($id)) {
        $response = [
          'code' => 400,
          'status' => 'Bad Request',
          'message' => 'Invalid ID value. ID must be a positive numeric value.',
        ];
      } else {
        if (!empty($id)) {
          $mahasiswa = $this->mahasiswa->getMahasiswaById($id);

          if ($mahasiswa) {
            $response = [
              'code' => 200,
              'status' => 'OK',
              'data' => $mahasiswa,
            ];
          } else {
            $response = [
              'code' => 404,
              'status' => 'Not Found',
              'message' => 'The requested resource was not found.',
            ];
          }
        } else {
          $page = ($page !== null) ? (int) $page : 1;
          $start = ($page - 1) * $limit;

          if (!is_numeric($page) || $page < 1 || $start >= $totalRows) {
            $response = [
              'code' => 200, // Change the code to 200 OK
              'status' => 'OK',
              'data' => []
            ];
          } else {
            $mahasiswa = $this->mahasiswa->getMahasiswaWithLimit($start, $limit);

            $response = [
              'code' => 200,
              'status' => 'OK',
              'data' => $mahasiswa,
              'links' => $this->generatePaginationLinks($page, $totalPages),
              'meta' => [
                'current_page' => $page,
                'from' => $start + 1,
                'last_page' => $totalPages,
                'path' => base_url() . uri_string(),
                'per_page' => $limit,
                'to' => min($start + $limit, $totalRows),
                'total' => $totalRows,
                'limit' => $limit,
              ],
            ];
          }
        }
      }
    }

    return $this->response($response, $response['code']);
  }

  private function generatePaginationLinks($currentPage, $totalPages)
  {
    $links = [
      'first' => $this->generatePageUrl(1),
      'last' => $this->generatePageUrl($totalPages),
      'prev' => null,
      'next' => null,
    ];

    if ($currentPage > 1) {
      $links['prev'] = $this->generatePageUrl($currentPage - 1);
    }

    if ($currentPage < $totalPages) {
      $links['next'] = $this->generatePageUrl($currentPage + 1);
    }

    return $links;
  }

  private function generatePageUrl($page)
  {
    $query = http_build_query([
      'page' => $page
    ]);

    return current_url() . '?' . $query;
  }

  public function index_post($id = null)
  {
    $id = $this->uri->segment(3);
    if (empty($id)) {
      $this->load->library('upload');

      $rules = $this->rules();
      $this->form_validation->set_rules($rules);

      if ($this->form_validation->run() == FALSE) {
        // Validasi gagal
        $validationErrors = $this->form_validation->error_array();
        $response = [
          'code' => 422,
          'status' => 'Unprocessable Entity',
          'message' => 'Validation failed',
          'errors' => $validationErrors
        ];
      } else {
        $gambar = null;
        $file = isset($_FILES['gambar']) ? $_FILES['gambar'] : null;

        if (!empty($file['name'])) {
          $config['upload_path'] = './uploads/';
          $config['allowed_types'] = 'jpeg|gif|jpg|png';
          $config['max_size'] = 2048;
          $config['encrypt_name'] = true;
          $this->upload->initialize($config);

          // Validasi gambar
          if (!$this->upload->do_upload('gambar')) {
            $validationErrors['gambar'] = strip_tags($this->upload->display_errors());
            $response = [
              'code' => 422,
              'status' => 'Unprocessable Entity',
              'message' => 'Validation failed',
              'error' =>  $validationErrors['gambar']
            ];
          } else {
            $gambarData = $this->upload->data();
            $gambar = $gambarData['file_name'];
          }
        }

        if (!isset($response)) { // Tambahkan kondisi untuk memastikan tidak ada response sebelumnya
          $data = [
            'nama' => $this->input->post('nama'),
            'email' => $this->input->post('email'),
            'jurusan' => $this->input->post('jurusan'),
            'gambar' => $gambar,
            'createdAt' => date('Y-m-d H:i:s'),
          ];

          // Tidak ada error validasi
          if ($this->mahasiswa->createMahasiswa($data)) {
            $gambarUrl = $gambar ? base_url('uploads/') . $gambar : null;
            $response = [
              'code' => 201,
              'status' => 'Created',
              'message' => 'Data berhasil ditambahkan',
              'data' => [
                'nama' => $data['nama'],
                'email' => $data['email'],
                'jurusan' => $data['jurusan'],
                'gambar' => $data['gambar'],
                'gambar_url' => $gambarUrl,
              ]
            ];
          }
        }
      }
    }
    return $this->response($response, $response['code']);
  }


  public function index_put($id)
  {
    if (!empty($id)) {
      $this->load->library('upload');
      $rules = $this->rules();
      $this->form_validation->set_rules($rules);

      $existingData = $this->mahasiswa->getMahasiswa($id);
      if (!$existingData) {
        $response = [
          'code' => 404,
          'status' => 'Not Found',
          'message' => 'Resource not found or invalid ID'
        ];
      } else {

        if ($this->form_validation->run() == FALSE) {
          // Validasi gagal

          $response = [
            'code' => 422,
            'status' => 'Unprocessable Entity',
            'message' => 'Validation failed',
            'errors' =>   $this->form_validation->error_array()
          ];
        } else {
          $file = $_FILES['gambar'];
          $gambar = null;

          if (!empty($file['name'])) {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'jpeg|gif|jpg|png';
            $config['max_size'] = 2048;
            $config['encrypt_name'] = true;
            $this->upload->initialize($config);

            // Validasi gambar
            if ($this->upload->do_upload('gambar')) {
              $gambarData = $this->upload->data();
              $gambar = $gambarData['file_name'];

              if ($this->mahasiswa->checkImageExists($id)) {
                $existingData = $this->mahasiswa->getMahasiswa($id);
                $oldImageName = $existingData['gambar'];
                // Hapus gambar lama
                $oldImagePath = './uploads/' . $oldImageName;
                if (file_exists($oldImagePath) && is_file($oldImagePath)) {
                  unlink($oldImagePath);
                }
              }
            } else {
              $response = [
                'code' => 422,
                'status' => 'Unprocessable Entity',
                'message' => 'Validation failed',
                'errors' => ['gambar' => $this->upload->display_errors()]
              ];
              return $this->response($response, $response['code']);
            }
          }

          $data = [
            'nama' => $this->input->post('nama'),
            'email' => $this->input->post('email'),
            'jurusan' => $this->input->post('jurusan'),
            'gambar' => isset($gambar) ? $gambar : $existingData['gambar'], // Menggunakan gambar lama jika tidak ada file yang diunggah
          ];

          // Tidak ada error validasi
          if ($this->mahasiswa->updateMahasiswa($data, $id)) {
            $gambarUrl = isset($gambar) ? base_url('uploads/') . $gambar : ($existingData['gambar'] ? base_url('uploads/') . $existingData['gambar'] : null);
            $response = [
              'code' => 200,
              'status' => 'OK',
              'message' => 'Data berhasil diubah',
              'data' => [
                'nama' => $data['nama'],
                'email' => $data['email'],
                'jurusan' => $data['jurusan'],
                'gambar' => $data['gambar'],
                'gambar_url' => $gambarUrl,
              ]
            ];
          }
        }
      }

      return $this->response($response, $response['code']);
    }
  }




  public function index_delete($id)
  {

    if (empty($id) || !ctype_digit($id)) {
      $response = [
        'code' => 400,
        'status' => 'Bad Request',
        'message' => 'Invalid ID value. ID must be a positive numeric value.',
      ];
    } else {
      // Periksa apakah Mahasiswa dengan ID yang diberikan ada
      $mahasiswa = $this->mahasiswa->getMahasiswa($id);

      $response = [
        'code' => 404,
        'status' => 'NOT FOUND',
        'data' => 'The requested resource was not found.'
      ];

      $gambar = $mahasiswa['gambar'] ?? null;

      if (!empty($gambar)) {
        $gambarPath = './uploads/' . $gambar;
        if (file_exists($gambarPath) && is_file($gambarPath)) {
          unlink($gambarPath);
        }
      }

      // Hapus data mahasiswa
      $deleted = $this->mahasiswa->deleteMahasiswa($id);
      if ($deleted) {
        $response = [
          'code' => 204,
          'status' => 'SUCCESS',
          'data' => 'The resource has been deleted.'
        ];
      }
    }
    return $this->response($response, $response['code']);
  }
}
