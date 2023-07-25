<?php

namespace App\Models;

use App\Models\Services;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    public function Services ()
    {
        return $this->hasMany(Services::class);

    }

}
