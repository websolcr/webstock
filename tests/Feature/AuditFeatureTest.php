<?php

namespace Tests\Feature;

use Support\Audit\AuditArea;
use Domain\Audit\Models\Audit;
use Support\Audit\AuditAction;

beforeEach(fn () => beginTestInsideTenant());

afterEach(fn () => endTestInsideTenant());

test('list all audits', function () {
    Audit::factory(10)->create();

    $response = $this->getJson('api/audits?'.http_build_query([
            'perPage' => 5,
        ]));

    $response->assertJsonCount(5, 'data');
});

test('can filter audit records for given filters', function () {
    Audit::factory()->create([
        'action' => AuditAction::SEND,
        'area' => AuditArea::INVITATION,
    ]);

    $response = $this->getJson('api/audits?'
        .http_build_query(
            [
                'filters' => [
                    'action' => ['send'],
                    'area' => ['invitation'],
                ],
                'perPage' => 5,
            ],
        ));

    $response->assertJsonCount(1, 'data');
});
