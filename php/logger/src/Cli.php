<?php

namespace Logger;

class Cli
{
    public static function main()
    {
        $logger = new \Fluent\Logger\FluentLogger("localhost", 24224);
//        $logger = new \Fluent\Logger\FluentLogger("10.29.0.133", 24224);

        $count = 1000000;

        while ($count-- > 0)
        {
            $length = rand(1024 * 512, 1024 * 1024); //512k ~ 1MB
            $data = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
            $logger->post("testFluentBitPost", ["hello" => $data]);
        }
    }
}