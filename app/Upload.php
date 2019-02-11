<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    protected $table = 'uploads';

    //protected $timestamp = false; remove if you want no timestamp on table

    protected $fillable = ['id','user_id', 'url', 'img_src','media_file_size'];
}
