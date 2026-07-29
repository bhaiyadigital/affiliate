<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(Content::class, 'category_id');
    }
}
