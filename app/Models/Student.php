<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'classes_id',
        'role_id',
        'user_id'
    ];
    public function user(){
        return $this->belongsTo(User::class, 'id', 'id');
    }

    public function class(){
        return $this->hasMany(Classes::class);
    }
}
