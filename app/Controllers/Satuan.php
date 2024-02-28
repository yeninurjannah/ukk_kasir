<?php

namespace App\Controllers;

class Satuan extends BaseController
{
    public function satuan()
    {
        return view('dashboard-admin');
    }
    public function dataSatuan()
    {
        $data = [
           'listSatuan' => $this->satuan->findAll()
         ];  
         return view('satuan/data-satuan',$data);
 }
 public function  tambahSatuan()
     {

        return view('satuan/tambah-satuan');
        
     } 
     public function simpanSatuan()
     {
        $data = [
            'nama_satuan'=> $this->request->getVar('nama_satuan')
        ];
        $this->satuan->save($data);
        return redirect()->to('data-satuan')->with('pesan', 'Data telah tersimpan.');
    }
        public function hapusSatuan($idsatuan){
            $syarat=[
                'id_satuan'=>$idsatuan
            
            ];
            $this->satuan->where($syarat)->delete();
            return redirect()->to('data-satuan')->with('pesan', 'Data telah terhapus.');
        }

        public function editSatuan($idsatuan){
            $syarat=[
                  'id_satuan'=>$idsatuan
            ];
            $data=[

                'title' => 'edit data',
                'judulHalaman' => 'edit data satuan',
                'listSatuan' => $this->satuan->where($syarat)->findAll()
                 ];

            return view('satuan/edit-satuan', $data);    
        }
        public function UpdateSatuan(){
            $data=[
                'id_satuan'=>$this->request->getVar('id_satuan'),
                'nama_satuan'=>$this->request->getVar('nama_satuan'),
            ];
            $this->satuan->update($this->request->getVar('id_satuan'),$data);
            return redirect()->to('data-satuan')->with('pesan', 'Data telah teredit.');
        }
        public function cek_keterkaitan_data($id)
    {
        // Lakukan pemeriksaan keterkaitan data
        $keterkaitan = $this->satuan->cekKeterkaitan($id);

        // Kirim respon ke AJAX
        return $this->response->setJSON(['has_keterkaitan' => $keterkaitan]);
    }
     }
