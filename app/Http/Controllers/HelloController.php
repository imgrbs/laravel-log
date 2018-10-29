<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HelloController extends Controller
{
    /**
     * @api {get} /hello
     * @apiName Get Hello
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "user-agent": "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.67 Safari/537.36",
     *       "ip": "127.0.0.1"
     *     }
     */
    public function getHello(Request $request) {
        $userAgent = $request->header('User-Agent');
        $ip = $request->ip();
        Log::info('IP:' . $ip . ', User-Agent:' . $userAgent);
        return response()->json([
            'user-agent' => $userAgent,
            'ip' => $ip,
        ]);
    }
}
