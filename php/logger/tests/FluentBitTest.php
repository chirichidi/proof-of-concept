<?php

class FluentBitTest extends \PHPUnit\Framework\TestCase
{
    public function testFluentBitPost()
    {
        //given
        $logger = new \Fluent\Logger\FluentLogger("localhost", 24224);

        //when
        $logger->post("testFluentBitPost", ["hello" => "world"]);

        //then
    }
}