<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    protected $table = 'downloads';
    public $timestamps = false;
    protected $fillable =['download_count'];
}
