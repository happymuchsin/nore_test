<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListItem extends Model
{
    use HasFactory;

    protected $table = "listitem";
    protected $fillable = [
        'name',
        'price',
    ];
}
