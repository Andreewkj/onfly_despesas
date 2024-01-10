<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ExpenditureController extends Controller
{
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
