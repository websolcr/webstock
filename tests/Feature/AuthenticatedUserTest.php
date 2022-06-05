<?php

test('get details of authenticated user', function () {
    beginTestInsideTenant();

    $response = $this->getJson('/api/myself');

    $user = auth()->user();

    $response->assertJson([
        'id' => $user->id,
        'name' => $user->name,
        'email' => $user->email,
    ]);

    endTestInsideTenant();
});
