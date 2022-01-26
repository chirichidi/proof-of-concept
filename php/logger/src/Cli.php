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
            $value = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);

            $datetime = date('Y-m-d H:i:s');
            $game = 'test_game';
            $type = 'fluentd';
            $signature = md5(implode([$datetime, $game, $type, 'test_key']));
            $record = [
                'datetime' => date('Y-m-d H:i:s'),
                'game' => $game,
                'type' => $type,
                'signature' => $signature,
                'data' => [
                    'key' => $value
                ]
            ];
//            $data = json_encode($data);
            $logger->post("bie-sc2bq-log.test", ["record" => $record]); // /data/log/scribe/default_primary/bie-sc2bq-log.test
        }
    }
}