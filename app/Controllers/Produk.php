<?php

namespace App\Controllers;

class Produk extends BaseController
{
    public function produk()
    {
        return view('dashboard-admin');
    }
    public function dataProduk()
    {
        $data = [
        
           'listProduk' => $this->produk->getProduk()
         ];  
         return view('produk/data-produk',$data);
 }
 public function  tambahProduk() {
    $data = [
          'validation' => \Config\Services::validation(),
          'kategori' =>$this->kategori->findAll(),
          'satuan' =>$this->satuan->findAll(),
          'kodeProduk' =>$this->produk->generateProductCode()
    ];
     return view('produk/tambah-produk',$data);
}


     public function simpanProduk()
      
     {
        $kodeProduk = $this->produk->generateProductCode();
        $this->produk->save([
            
            'kode_produk'=> $kodeProduk,
            'nama_produk'=> $this->request->getVar('namaProduk'),
            'harga_beli'=> str_replace('.', '', $this->request->getVar('hargaBeli')),
            'harga_jual'=> str_replace('.', '', $this->request->getVar('hargaJual')),
            'id_satuan'=> $this->request->getVar('Satuan'),
            'id_kategori'=> $this->request->getVar('Kategori'),
            'stok'=> str_replace('.', '', $this->request->getVar('stok')),
        ]);
       
        return redirect()->to('/data-produk')->with('pesan', 'Data telah tersimpan.');
    }

        public function hapusProduk($idproduk){
            $syarat=[
                'id_produk'=>$idproduk
            
            ];
            $this->produk->where($syarat)->delete();
            return redirect()->to('data-produk')->with('pesan', 'Data telah terhapus.');
        }
        public function delete($id)
    {
        $this->produk->delete($id);
        return redirect()->to('data-produk')->with('pesan', 'Data Berhasil Dihapus');
    }
        public function editProduk($idproduk){
            $syarat=[
                  'id_produk'=>$idproduk
            ];
            $data=[

                'title' => 'edit data',
                'judulHalaman' => 'edit data produk',
                'listProduk' => $this->produk->find($syarat),
                'kategori' =>$this->kategori->findAll(),
                'satuan' =>$this->satuan->findAll(),
                 ];

            return view('produk/edit-produk', $data);    
        }
        public function UpdateProduk(){
            $data=[
                'id_produk'=>$this->request->getVar('id_produk'),
                'kode_produk'=>$this->request->getVar('kode_produk'),
                'nama_produk'=>$this->request->getVar('namaProduk'),
                'satuan_produk'=>$this->request->getVar('Satuan'),
                'id_kategori'=>$this->request->getVar('Kategori'),
                'harga_beli'=>str_replace('.', '',$this->request->getVar('hargaBeli')),
                'harga_jual'=>str_replace('.', '',$this->request->getVar('hargaJual')),
                'stok'=>$this->request->getVar('stok'),
            ];
            // var_dump($data);
            $this->produk->update($this->request->getVar('id_produk'),$data);
            return redirect()->to('data-produk')->with('pesan', 'Data telah teredit.');
        }
        
}
