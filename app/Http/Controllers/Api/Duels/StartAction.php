<?php

namespace App\Http\Controllers\Api\Duels;

use App\Http\Controllers\Controller;

class StartAction extends Controller
{
    public function __invoke(): string
    {
        return response()->json();
    }
}
