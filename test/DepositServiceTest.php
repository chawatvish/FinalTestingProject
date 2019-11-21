<?php

require_once __DIR__.'./../src/deposit/DepositService.php';

use PHPUnit\Framework\TestCase;
use Operation\DepositService;

final class DepositServiceTest extends TestCase
{
    public function testDepositWithStub()
    {
        $inputs = $this->inputDataProvider();
        for ($x = 0;$x < sizeof($inputs);$x++) {
            $expected = $inputs[$x][0];
            $accNum = $inputs[$x][1];
            $amount = $inputs[$x][2];
            $depositHandler = new DepositService($accNum, true, true);
            $output = $depositHandler->deposit($amount);
            $this->assertEquals($expected, $output->errorMessage);
        }
    }

    // public function testDepositWithOutStub($expected, $accNum, $amount)
    // {
    //     $depositHandler = new DepositService($accNum, true, true);
    //     $output = $depositHandler->deposit($amount);
    //     $this->assertEquals($expected, $output->errorMessage);
    // }

    public function inputDataProvider()
    {
        return[
            //normal
            ['','0000000001','50'],
            ['','0000000001','5100'],
            //amount not number
            ['Amount must be numeric!','0000000001',''],
            ['Amount must be numeric!','0000000001','Million'],

            //accNo not co,plete
            ['Account No. must have have 10 digit!','000000001','50'],
            ['Account No. must have have 10 digit!','00000000001','5100'],

            //accNo not a number
            ['Account no. must be numeric!','myaccountt','50'],

           //accNo not found
            ['Account number : 0000000002 not found.','0000000002','50']




        ];
    }
}
