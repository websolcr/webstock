<?php

test('can get initialized organization details', function () {
    beginTestInsideTenant();

    $response = $this->getJson('/api/active-tenant');

    $response->assertOk();

    endTestInsideTenant();
});
