<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    use HasFactory;
    protected $table = 'customers';
    protected $primarykey = 'id';
    protected $fillable = ['id', 'nama_penyewa', 'alamat', 'no_telp', 'email'];
   
    public function order(){
        return $this->hasMany(order::class);
    }
}