<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierModel extends Model
{
    use HasFactory;
    protected $table = 'm_supplier';

    protected $primaryKey = 'supplier_id';

    protected $fillable = [
        'nama_supplier',
        'alamat',
        'telepon'
    ];

    public $timestamps = false;

    // Contoh relasi ke Barang (jika ada)
    public function barangs()
    {
        return $this->hasMany(BarangModel::class, 'supplier_id');
    }
}
