<?php
/**
 * Created by PhpStorm.
 * User: ${蒋华}
 * Date: 2019/1/21
 * Time: 17:56
 */
use Workerman\Worker;
use Workerman\Connection\TcpConnection;
require_once __DIR__.'/../Autoloader.php';


TcpConnection::$defaultMaxSendBufferSize = 2*1024*1024;


// 注意：这里与上个例子不同，使用的是websocket协议
$ws_worker = new Worker("websocket://0.0.0.0:2345");

// 启动4个进程对外提供服务
$ws_worker->count = 4;
// 设置实例的名称
$ws_worker->name = 'test';
$ws_worker->protocol = 'Workerman\\Protocols\\websocket';

// 当收到客户端发来的数据后返回hello $data给客户端
$ws_worker->onMessage = function($connection, $data)
{
    // 向客户端发送hello $data
    $connection->send('hello ' . $data);
};

// 运行worker
Worker::runAll();