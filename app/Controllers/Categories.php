<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class Categories extends ResourceController
{
    use ResponseTrait;

    protected $modelName = 'App\Models\CategorieModel';
    protected $format = 'json';

    public function index()
    {
        $search = $this->request->getVar('search');

        if ($search) {
            $this->model->like('nama_kategori', $search);
        }

        $kategori = $this->model->getkategoriWithProdukAndStok()->findAll();
        return $this->respond($kategori);
    }

    public function create()
    {
        $data = [
            'nama_kategori' => $this->request->getVar('nama_kategori')
        ];

        $this->model->insert($data);
        return $this->respond(['status' => 'Kategori created']);
    }

    public function show($id = null)
    {
        $kategori = $this->model->find($id);
        if (!$kategori) {
            return $this->failNotFound('Kategori not found');
        }
        return $this->respond($kategori);
    }

    public function change($id = null)
    {
        // Temukan kategori berdasarkan ID yang diberikan
        $category = $this->model->find($id);

        if (!$category) {
            return $this->failNotFound('Kategori tidak ditemukan');
        }

        // Data yang akan di-update, diambil dari input request
        $data = [
            'nama_kategori' => $this->request->getVar('nama_kategori')
        ];

        // Update data kategori
        if ($this->model->update($id, $data)) {
            return $this->respond(['status' => 'Kategori berhasil diperbarui']);
        }

        return $this->fail('Gagal memperbarui kategori');
    }


    public function delete($id = null)
    {
        $deleted = $this->model->delete($id);
        if ($deleted) {
            return $this->respondDeleted(['status' => 'Kategori deleted']);
        }
        return $this->failNotFound('Kategori not found');
    }
}
