<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HelloController extends Controller
{
    public function getHello(Request $request) {
        Log::info('IP:' .  $request->ip() . ', User-Agent:' . $request->header('User-Agent'));
        return response()->json([
            'header' => $request->header(),
            'ip' => $request->ip(),
        ]);
    }
}
