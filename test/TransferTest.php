<?php

include_once __DIR__ . "/../src/transfer/Transfer.php";
include_once __DIR__ . "/../src/transfer/StubServiceAuthentication.php";
include_once __DIR__ . "/../src/transfer/StubDBConnection.php";

use Operation\Transfer;
use PHPUnit\Framework\TestCase;
use Stub\StubServiceAuthentication;
use Stub\StubDBConnection;

class TransferTest extends TestCase
{
    public function testOverTC001()
    {
        $transfer = new Transfer('3333333001', 'TEST 001', new StubServiceAuthentication(), new StubDBConnection());
        $result2 = $transfer->doTransfer('3333333005', 5000);
        $this->assertSame(false, $result2['isError']);
    }
}