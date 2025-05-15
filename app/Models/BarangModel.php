<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangModel extends Model
{
    use HasFactory;
    protected $table = 'm_barang';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_barang',
        'kategori_id',
        'supplier_id',
        'stok',
        'harga'
    ];

    public $timestamps = false;

    public function kategori()
    {
        return $this->belongsTo(KategoriModel::class, 'kategori_id', 'kategori_id');
    }

   // Di model Barang
    public function supplier()
    {
        return $this->belongsTo(SupplierModel::class, 'supplier_id'); // Pastikan menggunakan kolom yang benar untuk relasi
    }
}
