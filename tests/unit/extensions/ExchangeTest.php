<?php

namespace tests\extensions;
use app\extensions as E;

class ExchangeTest extends  \Codeception\Test\Unit
{
    public function testGetrates(){
        $exchange = new E\Exchange();
        expect(count($exchange->getRates(100, '2017-04-01')), 1);
    }
}