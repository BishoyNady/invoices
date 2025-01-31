<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    
    protected $fillable = [
        'product_name',
        'description',
        'section_id',
    ];

    public function section()
    {
        return $this->belongsTo(section::class);
    }
}
