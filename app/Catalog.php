<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'catalog';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'catalogid', 'name'
    ];

    public function subCatalogs(){
        return $this->hasMany('App\SubCatalog','foreign_key');
    }

    public $timestamps = false;
}
