<?php

namespace App\Controllers;

class Kategori extends BaseController
{
    public function kategori()
    {
        return view('dashboard-admin');
    }
    public function dataKategori()
    {
        $data = [
           'listKategori' => $this->kategori->findAll()
         ];  
         return view('kategori/data-kategori',$data);
 }
 public function  tambahKategori()
     {

        return view('kategori/tambah-kategori');
        
     } 
     public function simpanKategori()
     {
        $data = [
            'nama_kategori'=> $this->request->getVar('nama_kategori')
        ];
        $this->kategori->save($data);
        return redirect()->to('/data-kategori')->with('pesan', 'Data telah tersimpan.');
    }

        public function hapusKategori($idkategori){
            $syarat=[
                'id_kategori'=>$idkategori
            
            ];
            $this->kategori->where($syarat)->delete();
            return redirect()->to('data-kategori')->with('pesan', 'Data telah terhapus.');
        }

        public function editKategori($idkategori){
            $syarat=[
                  'id_kategori'=>$idkategori
            ];
            $data=[

                'title' => 'edit data',
                'judulHalaman' => 'edit data kategori',
                'listKategori' => $this->kategori->where($syarat)->findAll()
            ];

            return view('kategori/edit-kategori', $data);    
        }
        public function UpdateKategori(){
            $data=[
                'id_kategori'=>$this->request->getVar('id_kategori'),
                'nama_kategori'=>$this->request->getVar('nama_kategori'),
            ];
            $this->kategori->update($this->request->getVar('id_kategori'),$data);
            return redirect()->to('data-kategori')->with('pesan', 'Data telah teredit.');
        }
        public function cek_keterkaitan_data($id)
    {
        // Lakukan pemeriksaan keterkaitan data
        $keterkaitan = $this->kategori->cekKeterkaitan($id);

        // Kirim respon ke AJAX
        return $this->response->setJSON(['has_keterkaitan' => $keterkaitan]);
    }
}