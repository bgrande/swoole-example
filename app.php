<?php
declare(strict_types=1);

use Swoole\Http\Request;
use Swoole\Http\Response;
use Swoole\Http\Server;

include_once __DIR__ . '/vendor/autoload.php';

$server = new Server('0.0.0.0', 8080, SWOOLE_PROCESS);

$server->set([
    //'worker_num' => 4,
    //'reactor_num' => 1,
    'log_level' => 3,
    'log_file' => '/dev/stdout',
    'task_worker_num' => 0,
    'task_use_object' => true,
    'enable_coroutine' => true,
]);

$server->on("start", function (Server $server) {
    echo "Swoole http server has been started at: htt://0.0.0.0:8080\n";
});

$server->on("request", function (Request $request, Response $response) {
    $response->header('Connection', 'close');
    $response->header('Content-Type', 'application/json');
    $response->end('{"message": "Hello World"}');
    echo "we did a response";
});

$server->start();