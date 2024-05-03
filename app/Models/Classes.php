<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'shift',
        'year',
        'subjects_id',
        'user_id'
    ];
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function subject(){
        return $this->belongsToM('App\Models\Subjects');
    }
}
