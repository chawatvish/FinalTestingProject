<?php namespace Operation;

require_once __DIR__ . './../serviceauthentication/DBConnection.php';
require_once __DIR__ . './../serviceauthentication/ServiceAuthentication.php';

use ServiceAuthentication;
use DBConnection;

class Transfer
{
    private $srcNumber, $srcName;
    private $service, $dbConnection;

    public function __construct(string $srcNumber,
        string $srcName,
        ServiceAuthentication $service,
        DBConnection $dbConnection) {

        $this->srcNumber = $srcNumber;
        $this->srcName = $srcName;

        if ($service == null) {
            $this->service = ServiceAuthentication();
        }

        if ($dbConnection == null) {
            $this->service = DBConnection();
        }
    }

    public function doTransfer(string $targetNumber, float $amount)
    {
        $response = array("isError" => true);
        $srcBal = 0;
        $toBal = 0;

        if (strlen($targetNumber) != 10 || !is_numeric($targetNumber)) {
            $response["message"] = "หมายเลขบัญชีไม่ถูกต้อง";
            return $response;
        }

        try {
            // 1----  Check toAcctNo is aready set in system
            $result = $service::accountAuthenticationProvider($targetNumber);
            $acctNo = $result["accNo"];
            $toBal = floatval($result["accBalance"]);

            // 2----  withdraw from scrAcctNo
            $result = $service::accountAuthenticationProvider($this->srcNumber);
            $srcBal = floatval($result["accBalance"]);

            if ($srcBal < $amount) {
                $response["isError"] = true;
                throw new AccountInformationException("ยอดเงินไม่เพียงพอ");
            }

            $srcBalAfter = $srcBal - $amount;
            $dbConnection::saveTransaction($this->srcNumber, $srcBalAfter);

            $toBalAfter = $toBal + $amount;
            $dbConnection::saveTransaction($targetNumber, $toBalAfter);

            $response["isError"] = false;
            $response["message"] = $srcBalAfter;
        } catch (Exception $e) {
            $response["message"] = $e->getMessage();
        }

        return $response;
    }
}
