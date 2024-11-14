<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class Stock extends ResourceController
{
    use ResponseTrait;

    protected $modelName = 'App\Models\StockModel';
    protected $format = 'json';

    public function index()
    {
        $stok = $this->model->getStokWithProduk()->findAll();
        return $this->respond($stok);
    }

    public function create()
    {
        $data = [
            'id_produk' => $this->request->getVar('id_produk'),
            'jumlah_barang' => $this->request->getVar('jumlah_barang'),
            'tgl_update' => date('Y-m-d')
        ];

        $this->model->insert($data);
        return $this->respondCreated(['status' => 'Stok created']);
    }

    public function show($id = null)
    {
        $stok = $this->model->find($id);
        if (!$stok) {
            return $this->failNotFound('Stok not found');
        }
        return $this->respond($stok);
    }

    public function change($id = null)
    {
        // Ensure the `id_produk` parameter is provided in the request
        if (!$id) {
            return $this->failNotFound('ID produk tidak ditemukan');
        }

        // Try to find an existing stock entry for the given product ID
        $stock = $this->model->where('id_produk', $id)->first();

        // Prepare data to be used for either create or update
        $data = [
            'id_produk' => $id,
            'jumlah_barang' => $this->request->getVar('jumlah_barang'),
            'tgl_update' => date('Y-m-d')
        ];

        // If stock is found, update it
        if ($stock) {
            if ($this->model->update($stock['id_stok'], $data)) {
                return $this->respond(['status' => 'Stok berhasil diperbarui']);
            }
            return $this->fail('Gagal memperbarui stok');
        }

        // If no stock found, create a new entry
        if ($this->model->insert($data)) {
            return $this->respondCreated(['status' => 'Stok created']);
        }

        return $this->fail('Gagal membuat stok');
    }




    public function delete($id = null)
    {
        $deleted = $this->model->delete($id);
        if ($deleted) {
            return $this->respondDeleted(['status' => 'Stok deleted']);
        }
        return $this->failNotFound('Stok not found');
    }
}
