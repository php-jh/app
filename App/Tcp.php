<?php
/**
 * Created by PhpStorm.
 * User: ${蒋华}
 * Date: 2019/1/22
 * Time: 10:00
 */

use Workerman\Worker;
require_once __DIR__.'/../Autoloader.php';

/// 创建一个Worker监听2347端口，不使用任何应用层协议
$tcp_worker = new Worker("tcp://0.0.0.0:2345");

$tcp_worker->name = 'tcp';

// 启动4个进程对外提供服务
$tcp_worker->count = 4;

// 当客户端发来数据时
$tcp_worker->onMessage = function($connection, $data)
{
    var_dump($data);
    // 向客户端发送hello $data
    $connection->send('hello ' . $data);
};

// 运行worker
Worker::runAll();