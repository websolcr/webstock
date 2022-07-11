<?php

namespace Domain\Audit\Models;

use App\HasUuid;
use App\Models\BaseModel;
use Domain\Member\Models\Member;
use Database\Factories\AuditFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Audit extends BaseModel
{
    use HasFactory;
    use HasUuid;

    protected $fillable = [
        'area',
        'member_id',
        'action',
        'after_value',
        'before_value',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
    ];

    public static function newFactory(): AuditFactory
    {
        return AuditFactory::new();
    }

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }
}
