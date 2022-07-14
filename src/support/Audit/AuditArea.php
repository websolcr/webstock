<?php

namespace Support\Audit;

enum AuditArea: int
{
    case ORGANIZATION = 1;
    case INVITATION = 2;
    case SUPPLIER = 3;

    private const VALUE_TO_NAME = [
        1 => 'organization',
        2 => 'invitation',
        3 => 'supplier',
    ];

    public static function getAllAreas(): array
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
