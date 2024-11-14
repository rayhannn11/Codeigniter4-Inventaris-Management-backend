<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'tbl_produk';
    protected $primaryKey = 'id_produk';
    protected $allowedFields = ['nama_produk', 'id_kategori', 'kode_produk', 'foto_produk', 'tgl_register'];

    public function getProdukWithKategoriAndStok()
    {
        return $this->select('tbl_produk.*, tbl_kategori.nama_kategori, tbl_stok.jumlah_barang, tbl_stok.tgl_update')
            ->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_produk.id_kategori', 'left')
            ->join('tbl_stok', 'tbl_stok.id_produk = tbl_produk.id_produk', 'left');
    }
}
