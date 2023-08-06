<?php

namespace Domain\Registration\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $table = 'applications';
    protected $guarded = [];
    // protected $casts = [
    //     'gender' => 'enum'
    // ];
}
