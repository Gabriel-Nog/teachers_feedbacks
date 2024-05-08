<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_id',
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

    public function subject(){
        return $this->hasMany(Subjects::class);
    }
}
