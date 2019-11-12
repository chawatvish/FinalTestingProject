<?php namespace Stub;

require_once __DIR__ . './../serviceauthentication/ServiceAuthentication.php';

use AccountInformationException;
use ServiceAuthentication;

class StubServiceAuthentication extends ServiceAuthentication
{
    public static function accountAuthenticationProvider(string $accNo): array
    {
        if ($accNo == '3333333001') {
            return array("accNo" => $accNo, "accName" => "TestAccountName", "accBalance" => 20000);
        } elseif ($accNo == '3333333005') {
            return array("accNo" => $accNo, "accName" => "TestAccountName", "accBalance" => 20000);
        } else {
            throw new AccountInformationException("Account number : " . $accNo . " not found.");
        }
    }
}
