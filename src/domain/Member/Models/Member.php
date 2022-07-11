<?php

namespace Domain\Member\Models;

use App\HasUuid;
use App\Models\BaseModel;
use Database\Factories\MemberFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Member extends BaseModel
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

    public static function newFactory(): MemberFactory
    {
        return MemberFactory::new();
    }

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function invitedBy(): BelongsTo
    {
        return $this->belongsTo(self::class, 'invited_by', 'id');
    }
}
