<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LevelModel extends Model
{
    use HasFactory;

    protected $table = 'm_level'; // Nama tabel

    protected $primaryKey = 'level_id'; // Primary key (default: id)

    protected $fillable = [
        'level_kode', 'level_nama'
    ];

    // Relasi ke UserModel jika ada
    public function users() 
    {
        return $this->hasMany(UserModel::class, 'level_id', 'level_id');
    }
    
}   