<?php

namespace App\Models;

use CodeIgniter\Model;

class CategorieModel extends Model
{
    protected $table = 'tbl_kategori';
    protected $primaryKey = 'id_kategori';
    protected $allowedFields = ['nama_kategori'];

    public function getkategoriWithProdukAndStok()
    {
        return $this->select('tbl_kategori.*, tbl_produk.id_produk, tbl_produk.nama_produk, tbl_stok.jumlah_barang, tbl_stok.tgl_update')
            ->join('tbl_produk', 'tbl_produk.id_kategori = tbl_kategori.id_kategori', 'left')
            ->join('tbl_stok', 'tbl_stok.id_produk = tbl_produk.id_produk', 'left');
    }
}
