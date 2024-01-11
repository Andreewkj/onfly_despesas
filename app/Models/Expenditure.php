<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenditure extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'description',
        'value',
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
