<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('invitations{tenantId}', function () {
    return true;
});
