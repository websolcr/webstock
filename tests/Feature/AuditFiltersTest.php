<?php

namespace Tests\Feature;

use App\Data\AuditData;

beforeEach(fn () => beginTestInsideTenant());

afterEach(fn () => endTestInsideTenant());

test('list all audit filters', function () {
    collect(['areas', 'actions'])->each(function (string $filter) {
        $response = $this->getJson('api/audit-data?'.http_build_query([
                'filter' => $filter,
            ]));

        $response->assertJson(AuditData::FILTERS[$filter]);
    });
});
