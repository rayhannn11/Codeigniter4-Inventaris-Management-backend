<?php

namespace App\Models;

use CodeIgniter\Model;

class StockModel extends Model
{
    protected $table = 'tbl_stok';
    protected $primaryKey = 'id_stok';
    protected $allowedFields = ['id_produk', 'jumlah_barang', 'tgl_update'];

    public function getStokWithProduk()
    {
        return $this->select('tbl_stok.*, tbl_produk.nama_produk')
            ->join('tbl_produk', 'tbl_stok.id_produk = tbl_produk.id_produk');
    }
}
