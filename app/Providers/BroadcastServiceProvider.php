<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Broadcast;

class BroadcastServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Broadcast::routes(['prefix' => 'api', 'middleware' => ['tenant']]);

        require base_path('routes/channels.php');
    }
}
