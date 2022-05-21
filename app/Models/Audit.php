<?php

namespace App\Models;

use App\HasUuid;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Audit extends AppModel
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

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }
}
