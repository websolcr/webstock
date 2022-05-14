<?php

namespace App\Models;

use App\HasUuid;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Member extends AppModel
{
    use HasFactory;
    use HasUuid;

    protected $fillable = [
        'global_id',
        'name',
        'email',
        'role',
        'invited_by',
    ];

    public static function id(): string
    {
        return self::where('global_id', auth()->id())->first()->id;
    }

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function invitedBy(): BelongsTo
    {
        return $this->belongsTo(self::class, 'invited_by', 'id');
    }
}
