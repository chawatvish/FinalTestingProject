<?php namespace Operation;

require_once __DIR__ . './../serviceauthentication/DBConnection.php';
require_once __DIR__ . './../serviceauthentication/StubServiceAuthentication.php';
require_once __DIR__ . './../serviceauthentication/ServiceAuthentication.php';

use AccountInformationException;
use DBConnection;
use ServiceAuthentication;

class Transfer {
    private $srcNumber, $srcName;
    public function __construct(string $srcNumber, string $srcName) {
        $this->srcNumber = $srcNumber;
        $this->srcName = $srcName;
    }
}