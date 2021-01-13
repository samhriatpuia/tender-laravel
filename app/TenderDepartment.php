<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TenderDepartment extends Model
{
    protected $table ='tender_department';

    public $timestamps = false;


    protected $fillable = [
        'name', 'parent', 'color','user_id','created','updated'
    ];
}
