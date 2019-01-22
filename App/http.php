<?php
/**
 * Created by PhpStorm.
 * User: ${蒋华}
 * Date: 2019/1/22
 * Time: 11:13
 */
use Workerman\Worker;
require_once __DIR__.'/../Autoloader.php';

// 将屏幕打印输出到Worker::$stdoutFile指定的文件中
Worker::$stdoutFile = './tmp/stdout.log';

$http_worker = new Worker("http://0.0.0.0:2345");
$http_worker->onMessage = function($connection, $data)
{
    $connection->send('hello world');
};

Worker::runAll();
