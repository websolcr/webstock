<?php

namespace Support\Audit;

enum AuditAction: int
{
    case SEND = 1;
    case ACCEPT = 2;
    case LOGIN = 3;
    case CREATE = 4;
    case UPDATE = 5;
    case DELETE = 6;

    private const VALUE_TO_NAME = [
        1 => 'send',
        2 => 'accept',
        3 => 'login',
        4 => 'create',
        5 => 'update',
        6 => 'delete',
    ];

    public static function getAllActions(): array
    {
        return collect(self::VALUE_TO_NAME)
            ->map(function ($value, $key) {
                return [
                'key' => $key,
                'value' => $value,
            ];
            })
            ->values()
            ->toArray();
    }

    public static function fromValue(int $value): string
    {
        return self::VALUE_TO_NAME[$value];
    }

    public static function fromName(string $name): self
    {
        return self::from(array_search($name, self::VALUE_TO_NAME));
    }
}
