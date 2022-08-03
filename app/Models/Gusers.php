<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gusers extends Model
{
    use HasFactory;

    protected static function getCurrentUid()
    {
        return Gusers::where("email", session()->get('email'))->get()->pluck('id')->first();
    }
}
