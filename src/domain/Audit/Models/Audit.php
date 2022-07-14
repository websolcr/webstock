<?php

namespace Domain\Audit\Models;

use App\HasUuid;
use App\Models\BaseModel;
use Support\Audit\AuditArea;
use Support\Audit\AuditAction;
use Domain\Member\Models\Member;
use Database\Factories\AuditFactory;
use Domain\Audit\QueryBuilders\AuditQueryBuilder;
use Illuminate\Database\Eloquent\Casts\Attribute;
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

    public function newEloquentBuilder($query): AuditQueryBuilder
    {
        return new AuditQueryBuilder($query);
    }

    public static function newFactory(): AuditFactory
    {
        return AuditFactory::new();
    }

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    protected function area(): Attribute
    {
        return new Attribute(
            get: fn (int $value) => AuditArea::from($value),
            set: fn (AuditArea $auditArea) => $auditArea->value,
        );
    }

    protected function action(): Attribute
    {
        return new Attribute(
            get: fn (int $value) => AuditAction::from($value),
            set: fn (AuditAction $auditAction) => $auditAction->value,
        );
    }
}
