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
}