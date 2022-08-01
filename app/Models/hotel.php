<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hotel extends Model
{
    protected $table = 'hotels';
    protected $primarykey = 'id_kamar';
    protected $fillable = ['id_kamar', 'nama_kamar', 'jenis_kamar', 'harga_kamar', 'deskripsi'];

    public function order() {
        return $this->hasMany(order::class);
    }
}
