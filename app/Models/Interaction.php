<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interaction extends Model
{
    use HasFactory;

    protected $primaryKey = ['user_id', 'blog_id'];
    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'blog_id',
        'interaction'
    ];

    public $timestamps = false; 
}
