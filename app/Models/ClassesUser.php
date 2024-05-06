<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassesUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'classes_id',
        'subject'
    ];

    public $timestamps = false;

    protected $table = 'classes_user';
}

