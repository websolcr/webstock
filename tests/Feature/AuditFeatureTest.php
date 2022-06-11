<?php

namespace Tests\Feature;

use Domain\Audit\Models\Audit;

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
        'action' => 'send',
        'area' => 'invitation',
    ]);

    $response = $this->getJson('api/audits?'.http_build_query(
        [
                'action' => 'send',
                'area' => 'invitation',
                'perPage' => 5,
            ]
    ));

    $response->assertJsonCount(1, 'data');
});
