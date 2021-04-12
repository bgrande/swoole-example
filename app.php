<?php
declare(strict_types=1);

use Swoole\Http\Request;
use Swoole\Http\Response;
use Swoole\Http\Server;

include_once __DIR__ . '/vendor/autoload.php';

$server = new Server('0.0.0.0', 8080);

$server->set([
    //'worker_num' => 4,
    //'reactor_num' => 1,
    'log_level' => 3,
    'log_file' => '/dev/stdout',
    //'task_worker_num' => 1,
    'task_use_object' => true,
    'enable_coroutine' => true,
]);

$server->on("start", function (Server $server) {
    echo "Swoole http server has been started at: htt://0.0.0.0:8080\n";
});

$languageList = ['java', 'css', 'go', 'javascript', 'typescript', 'rust', 'php', 'swoole', 'html', 'sql'];

$getLang = static function ($list) {
    $active = [];

    for ($i = 0; $i < 3; $i++) {
        $max = count($list) - 1;
        $index = floor(random_int(0, $max));
        if (!\in_array($list[$index], $active, true)) {
            $active[] = $list[$index];
        }
    }

    return $active;
};

$server->on("request", function (Request $request, Response $response) use ($getLang, $languageList, $server) {
    $response->header('Connection', 'close');
    $response->header('Content-Type', 'application/json');

    $currentList = $getLang($languageList);

    $result = [
        'message' => 'The languages of the day are',
        'list' => $currentList
    ];

    $response->end(json_encode($result));
    echo "we did a response";
});

$server->start();