<?php

namespace App\Data;

class AuditData
{
    const FILTERS = [
        'actions' => [
            'send',
            'accept',
            'login',
            'logout',
            'switch',
            'create',
            'update',
        ],

        'areas' => [
            'organization',
            'invitation',
            'supplier',
        ],
    ];
}
