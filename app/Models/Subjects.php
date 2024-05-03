<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subjects extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nome'
    ];
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
