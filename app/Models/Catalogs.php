<?php

namespace App\Models;
// namespace App\Modules\Vitrin\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Factories\HasFactory;

class Catalogs extends Model
{
    // use HasFactory;

    protected $table = 'cats';

    protected $fillable = [
        'name',
        'cat_id_up',
        'sort',
        'status'
    ];

    // protected static function newFactory()
    // {
    //     return \App\Modules\Vitrin\Database\factories\CatalogsFactory::new();
    // }
    public function items()
    {
        return $this->hasMany(Items::class);
    }
}
