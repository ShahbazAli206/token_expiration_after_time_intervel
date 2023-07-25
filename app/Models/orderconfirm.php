<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class orderconfirm extends Model
{
    protected $primaryKey = 'id'; 
    public $incrementing = false; 
    public function order()
    {
        return $this->belongsTo(order::class);

    }
}
