<?php namespace Operation;

use AccountInformationException;

class ServiceAuthenticationStub {

    public static function accountAuthenticationProvider(string $accNo): array {
        $response = array("accBalance" => 10000);
        if($accNo !== "1234567890"){
            throw new AccountInformationException("Account number : {$accNo} not found.");
        } 
        return $response;
    }

}