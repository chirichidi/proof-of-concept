<?php

class FluentBitTest extends \PHPUnit\Framework\TestCase
{
    public function testFluentBitPost()
    {
        //given
        $logger = new \Fluent\Logger\FluentLogger("localhost", 24224);

        //when
        $count = 1000000;
        while ($count-- > 0)
        {
            $logger->post("testFluentBitPost", ["hello" => "world"]);
//            $logger->post("testFluentBitPost", ["message_fluentd" => "message_fluentd"]);
        }

        //then
    }

    public function testScribeFormatTest()
    {
        //given
        $logger = new \Fluent\Logger\FluentLogger("localhost", 24224);

        /**
         * datetime
        game
        type
        signature
         */
        $data = [
            'datetime' => '2022-01-13 18:16:00',
            'game' => 'cpb_v22',
            'type' => 'game_access',
            'signature' => 'signature_test'
        ];
        $data = json_encode($data);

        //when
        $logger->post("testFluentBitPost", ["hello" => $data]);

        //then
    }
}