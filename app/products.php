<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    
    protected $fillable = [
        "product_name",
        "section_id",
        "description",
        //"created_by"
    ];
    public function section()
    {
        return $this->belongsTo('App\sections');
    }
}
