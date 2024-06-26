<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subjects extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome'
    ];

    public function user()
    {
        return $this->belongsToMany(User::class);
    }

    public function teacheSubject(){
        return $this->hasMany(Teacher::class);
    }
}
