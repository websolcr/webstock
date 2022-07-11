<?php

namespace Domain\Audit\QueryBuilders;

use Support\Audit\AuditArea;
use Support\Audit\AuditAction;
use Illuminate\Database\Eloquent\Builder;

class AuditQueryBuilder extends Builder
{
    public function whereInMemberId(array $memberIds): self
    {
        return $this->whereIn('member_id', $memberIds);
    }

    public function whereInArea(array $areas): self
    {
        return $this->whereIn(
            'area',
            $areas
        );
    }

    public function whereInAction(array $actions): self
    {
        return $this->whereIn(
            'action',
            $actions
        );
    }
}
