<?php

use Domain\Member\Models\Member;

beforeEach(fn () => beginTestInsideTenant());

afterEach(fn () => endTestInsideTenant());

test('list all members', function () {
    Member::factory(10)->create();

    $response = $this->getJson('/api/members');

    $response->assertJsonCount(10 + 1); //extra 1 is auth user
});
