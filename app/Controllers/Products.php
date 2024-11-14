<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class Products extends ResourceController
{
    use ResponseTrait;

    protected $modelName = 'App\Models\ProductModel';
    protected $format = 'json';

    public function index()
    {
        $search = $this->request->getVar('search');

        if ($search) {
            $this->model->like('nama_produk', $search);
        }

        $produk = $this->model->getProdukWithKategoriAndStok()->findAll();
        return $this->respond($produk);
    }

    public function create()
    {
        $data = [
            'nama_produk' => $this->request->getVar('nama_produk'),
            'id_kategori' => $this->request->getVar('id_kategori') ?? null,
            'kode_produk' => $this->request->getVar('kode_produk'),
            'tgl_register' => date('Y-m-d')
        ];



        $file = $this->request->getFile('foto_produk');
        if ($file->isValid()) {
            // Tambahkan random number untuk membuat nama file unik
            $fileName = pathinfo($file->getClientName(), PATHINFO_FILENAME); // nama file tanpa ekstensi
            $extension = $file->getClientExtension(); // ekstensi file
            $uniqueFileName = $fileName . '_' . uniqid() . '.' . $extension; // gabungkan nama file dengan uniqid dan ekstensi

            // Simpan file dengan nama unik ke folder 'products'
            $file->move('products', $uniqueFileName);

            // Simpan nama file unik ke dalam array data untuk disimpan ke database
            $data['foto_produk'] = $uniqueFileName;
        }

        // Insert data produk
        $this->model->insert($data);

        // Ambil ID produk yang baru dimasukkan
        $id_produk = $this->model->insertID;

        // Return response dengan ID produk
        return $this->respondCreated(['status' => 'Produk created', 'id_produk' => $id_produk]);
    }



    public function change($id = null)
    {
        // Temukan produk berdasarkan ID yang diberikan
        $product = $this->model->find($id);

        if (!$product) {
            return $this->failNotFound('Produk tidak ditemukan');
        }

        // Data yang akan di-update, diambil dari input request
        $data = [];
        if ($this->request->getVar('id_kategori') !== null) {
            $data['id_kategori'] = $this->request->getVar('id_kategori');
        }
        if ($this->request->getVar('nama_produk') !== null) {
            $data['nama_produk'] = $this->request->getVar('nama_produk');
        }
        if ($this->request->getVar('kode_produk') !== null) {
            $data['kode_produk'] = $this->request->getVar('kode_produk');
        }
        $data['tgl_register'] = date('Y-m-d');

        // Handle file upload untuk foto produk
        $file = $this->request->getFile('foto_produk');
        if ($file->isValid()) {
            // Tambahkan random number untuk membuat nama file unik
            $fileName = pathinfo($file->getClientName(), PATHINFO_FILENAME); // nama file tanpa ekstensi
            $extension = $file->getClientExtension(); // ekstensi file
            $uniqueFileName = $fileName . '_' . uniqid() . '.' . $extension; // gabungkan nama file dengan uniqid dan ekstensi

            // Simpan file dengan nama unik ke folder 'products'
            $file->move('products', $uniqueFileName);

            // Simpan nama file unik ke dalam array data untuk disimpan ke database
            $data['foto_produk'] = $uniqueFileName;
        }

        if (!empty($data) && $this->model->update($id, $data)) {
            return $this->respond(['status' => 'Produk berhasil diperbarui', 'id_produk' => $id]);
        }

        return $this->fail('Gagal memperbarui produk');
    }

    public function show($id = null)
    {
        $produk = $this->model->find($id);
        if (!$produk) {
            return $this->failNotFound('Produk not found');
        }
        return $this->respond($produk);
    }


    public function delete($id = null)
    {
        $deleted = $this->model->delete($id);
        if ($deleted) {
            return $this->respondDeleted(['status' => 'Produk deleted']);
        }
        return $this->failNotFound('Produk not found');
    }
}
