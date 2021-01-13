<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tender_main extends Model
{
    protected $table ='tender_mains';

    public $departmentName;

    public $timestamps = false;
    public function download()
    {
        return $this->belongsToMany(Download::class,'attachment','id');
    }
}
