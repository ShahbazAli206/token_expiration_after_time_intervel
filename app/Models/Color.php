<?php

namespace App\Models;

use App\Models\Item;
use App\Models\Services;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Color extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    public function Services ()
    {
        return $this->belongsToMany(Services::class);

    }

    public function items ()
    {
        return $this->hasMany(Item::class);

    }


}
