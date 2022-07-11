<?php

namespace Domain\Audit\Interfaces;

use Support\Audit\AuditArea;
use Support\Audit\AuditAction;

interface AuditableEvent
{
    public function member(): string;

    public function area(): AuditArea;

    public function action(): AuditAction;

    public function beforeValue(): ?string;

    public function afterValue(): ?string;
}
