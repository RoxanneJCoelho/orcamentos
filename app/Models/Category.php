<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // o model category é da tabela com o nome category
    protected $table = 'category';

    // uma categoria pode ter vários serviços
    public function services()
    {
        return $this->hasMany(Service::class, 'category_id');
    }
}
