<?php
require_once(__DIR__.'../../serviceauthentication/DBConnection.php');
require_once 'dbConnectorStub.php';

class ServiceAuthenticationStub {

    public static function accountAuthenticationProvider(string $accNo): array {
        return dbConnectorStub::getAccountInfo($accNo);
    }
}

?>