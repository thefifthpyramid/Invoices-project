<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class invoices extends Model
{
    protected $guarded = [];
    
    public function section()
    {
        return $this->belongsTo('App\sections');
    }
    use SoftDeletes;
}
