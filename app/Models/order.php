<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $primarykey = 'id';
    protected $fillable = ['id', 'checkin', 'checkout', 'no_ktp', 'total','customer_id', 'id_kamar'];

    public function customer()
    {
        return $this->belongsTo(customer::class, 'customer_id');
    }

    public function mobil()
    {
        return $this->belongsTo(mobil::class, 'id_kamar');
    }
}
