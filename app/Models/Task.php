<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'user_id', 'tags', 'name', 'description', 'status', 'created_at', 'updated_at'];
}

