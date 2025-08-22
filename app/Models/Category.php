<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';

    public function services()
    {
        return $this->hasMany(Service::class, 'category_id');
    }
}
