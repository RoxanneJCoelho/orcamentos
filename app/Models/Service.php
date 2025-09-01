<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    // o model service é da tabela com o nome service
    protected $table = 'service';

    // cada serviço pertence a uma categoria
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
