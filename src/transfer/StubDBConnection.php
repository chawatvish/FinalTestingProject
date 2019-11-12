<?php namespace Operation;

require_once __DIR__ . './../serviceauthentication/DBConnection.php';

use DBConnection;

class StubDBConnection implements DBConnection
{
    public static function saveTransaction(string $accNo, int $updatedBalance): bool {
        return true;
    }
}