<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Ward;

class DisTrict extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'district';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'district', 'name', 'proviceid'
    ];

    public function wards(){
        return Ward::where('districtid', $this->districtid)->get();
    }

    public $timestamps = false;
}
