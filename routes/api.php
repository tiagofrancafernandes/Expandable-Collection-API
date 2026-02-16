<?php

use Illuminate\Support\Facades\Route;

Route::get('/v1/health', fn (): array => [
    'status' => 'ok',
]);
