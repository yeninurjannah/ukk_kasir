<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class User extends BaseController
{
    public function index()
    {
        $data = [

            'akses' => session()->get('level'),
            'pendapatan_harian' =>  $this->penjualan->getPendapatanHarian(),
            'dataStok' =>  $this->produk->getStokNol() 
        ];
        return view('dashboard-admin', $data);
    }

    public function login()
    {
        return view('login');
    }


    public function dataUser()
    {
        $session = session();
        $session->set('akses', 'admin');
        $session->set('akses', 'kasir');

        $data = [
            'listUser' => $this->user->findAll(),
            'akses' => session('akses', 'level')
        ];
        return view('user/data-user', $data);
    }

    public function  tambahUser()
    {
        $data = [
            'listUser' => $this->user->findAll(),
        ];

        return view('user/tambah-user');
    }
    public function simpanUser()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'nama_user' => 'required',
            'username' => 'required|is_unique[tbl_user.username]',
            'password' => 'required',
            'level' => 'required',
        ];

        $messages = [
            'nama_user' => [
                'required' => 'Tidak boleh kosong!',
            ],
            'username' => [
                'required' => 'Tidak boleh kosong!',
                'is_unique' => 'username sudah ada silahkan gunakan yang lain',
            ],
            'password' => [
                'required' => 'Tidak boleh kosong!',
            ],
            'level' => [
                'required' => 'Tidak boleh kosong!',
            ],
        ];

        // set validasi
        $validation->setRules($rules, $messages);

        // cek validasi gagal
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
        $data = [
            'nama_user' => $this->request->getVar('nama_user'),
            'username' => $this->request->getVar('username'),
            'password' => $this->request->getVar('password'),
            'level' => $this->request->getVar('level')

        ];
        $this->user->save($data);
        session()->setFlashdata('pesan', 'data berhasil di tambahkan');
        return redirect()->to('/data-user');
        
    }

    public function hapusUser($iduser)
    {
        $syarat = [
            'id_user' => $iduser

        ];
        $this->user->where($syarat)->delete();
        return redirect()->to('data-user')->with('pesan', 'Data telah terhapus.');
    }

    public function editUser($iduser)
    {
        $syarat = [
            'id_user' => $iduser
        ];
        $data = [

            'title' => 'edit data',
            'judulHalaman' => 'edit data user',
            'listUser' => $this->user->where($syarat)->findAll()
        ];

        return view('user/edit-user', $data);
    }

    public function updateUser()
    {
        $data = [
            'id_user' => $this->request->getVar('id_user'),
            'nama_user' => $this->request->getVar('nama_user'),
            'username' => $this->request->getVar('username'),
            'password' => $this->request->getVar('password'),
            'level' => $this->request->getVar('level'),

        ];
        $this->user->update($this->request->getVar('id_user'), $data);
        return redirect()->to('data-user')->with('pesan', 'Data telah teredit.');
    }

    public function prosesLogin()
    {
        // 1 membuat validasi dorm
        $validasiForm = [
            'username' => 'required',
            'password' => 'required',
        ];
        if ($this->validate($validasiForm)) {
            // siapkan 2 var yaitu $user dan $pass
            $user = $this->request->getPost('username');
            $pass = $this->request->getPost('password');

            // var_dump($user, $pass);
            $whereLogin = [
                'username' => $user,
                'password' => $pass
            ];

            //select * from user where username='$user' and password='$pass'
            $cekLogin = $this->user->getUser($user, $pass);


            if (count($cekLogin) == 1) { //untuk kasus sukses login
                // jika ditemukan 1 data
                $dataSession = [
                    'id_user' => $cekLogin[0]['id_user'],
                    'username' => $cekLogin[0]['username'],
                    'password' => $cekLogin[0]['password'],
                    'level' => $cekLogin[0]['level'],
                    'sudahkahLogin' => true
                ];

                session()->set($dataSession);
                return redirect()->to('/dashboard-admin');

            } else {
                // jika tidak ditemukan data apapun
                return redirect()->to('/')->with('pesan1', '<p class="text-danger text-center">Username atau Password Salah.</p>');
            }
        }
    }

    public function logout()
    {
        
        session()->destroy();
        return redirect()->to('/');
    }
}
