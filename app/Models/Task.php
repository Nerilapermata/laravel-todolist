<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'is_done'];

    public function tags()
    {
        return $this->hasMany(Tag::class, 'task_id', 'id');
    }
}
