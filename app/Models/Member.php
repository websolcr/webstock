<?php

namespace App\Models;

class Member extends AppModel
{
    protected $fillable = [
        'global_id',
    ];

    public static function id(): string
    {
        return self::where('global_id', auth()->id())->first()->id;
    }
}
