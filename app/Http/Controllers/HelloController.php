<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use BracketGenerator\Bracket;

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
        $logData= [
            "ip" => $ip,
            "User-Agent" => $userAgent,
            "timestamps" => now()->toDateTimeString()
        ];
        Log::info(json_encode($logData));
        return response()->json($logData);
    }

    // ========================
    // Example Code
    // ========================
    // $teams = [
    //     [ 'Participant 1', 0 ],
    //     [ 'Participant 2', 0 ],
    //     [ 'Participant 3', 0 ],
    //     [ 'Participant 4', 0 ],
    //     [ 'Participant 5', 0 ],
    //     [ 'Participant 6', 0 ],
    // ];
    // $brackets = Bracket::create(6);
    // $brackets->fillByParticipantList($teams);
    // return response()->json($brackets->getTree());
    // ========================

    public function getBrackets(Request $request) {
        $teams = [
            [ 'Participant 1' ],
            [ 'Participant 2' ],
            [ 'Participant 3' ],
            [ 'Participant 4' ],
            [ 'Participant 5' ],
            [ 'Participant 6' ],
        ];
        shuffle($teams);

        $teamCount = count($teams);
        $matchs = array_fill(0, $teamCount / 2, []);
        $currentMatch = 0;
        for ($index = 0; $index < $teamCount; $index ++) {
            if (count($matchs[$currentMatch]) < 2) {
                $team = array_pop($teams[$index]);
                array_push($matchs[$currentMatch], $team);
            }
            if (count($matchs[$currentMatch]) == 2) {
                $currentMatch++;
            }
        }
        return response()->json($matchs);
    }
}
