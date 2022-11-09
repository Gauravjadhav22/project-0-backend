<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'address',
        'email',
        'name',
        'contact',
        'class name',
        'dob',
        'user_id',
    ];
    public function students()
    {
        return $this->belongsTo(User::class);
    }

    //add student

}
