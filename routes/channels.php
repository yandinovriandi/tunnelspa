<?php

use Illuminate\Support\Facades\Broadcast;
Broadcast::routes(['middleware' =>  'auth' ]);
Broadcast::channel('transaction.paid.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
