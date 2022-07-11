<?php

namespace Domain\Audit\Actions;

use Domain\Audit\Models\Audit;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ListAuditAction
{
    protected Collection $filters;

    protected const COLUMN_TO_QUERY = [
        'member' => 'whereInMemberId',
        'area' => 'whereInArea',
        'action' => 'whereInAction',
    ];

    public function execute(Collection $filters, int $perPage, int $page = 1): LengthAwarePaginator
    {
        $this->filters = $filters->reject(null);

        return Audit::query()
            ->with('member')
            ->when($this->filters->isNotEmpty(), function (Builder $query) use ($filters) {
                $query->where(function () use ($filters, $query) {
                    $filters->each(fn ($value, $key) => $query->{self::COLUMN_TO_QUERY[$key]}($value));
                });
            })
            ->paginate($perPage, ['*'], 'page', $page)
            ->withQueryString();
    }
}
