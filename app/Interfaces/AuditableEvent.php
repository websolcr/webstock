<?php

namespace App\Interfaces;

interface AuditableEvent
{
    public function member(): string;

    public function area(): string;

    public function action(): string;

    public function beforeValue(): ?string;

    public function afterValue(): ?string;
}
