<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_File extends Model
{
    protected $table = 'user_files';
    protected $fillable = [
        'path','user_id'
    ];
    
}
