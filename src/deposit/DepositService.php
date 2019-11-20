<?php namespace Operation;

require_once(__DIR__.'../../outputs/Outputs.php');
require_once(__DIR__.'../../serviceauthentication/serviceauthentication.php');
require_once(__DIR__.'../../serviceauthentication/DBConnection.php');
require_once 'serviceAuthenticationStub.php'; // stub
require_once 'dbConnectorStub.php'; // stub

use Output\Outputs;
use Exception;
use AccountInformationException;
use serviceauthentication;
use DBConnection;
use serviceAuthenticationStub; // stub
use dbConnectorStub; // stub
use phpDocumentor\Reflection\Types\Boolean;

class DepositService{

    private $accNo;
    
    public static $isTestAuthStub = true;
    public static $isTestTxStub = true;

    public function __construct(string $accNo){
        $this->accNo = $accNo;
    }

    public function DepositService(string $accNo,bool $isTestAuthStub,bool $isTestTxStub){
        $this->accNo = $accNo;
        $this->isTestAuthStub = $isTestAuthStub;
        $this->isTestTxStub = $isTestTxStub;
    }
    
    // main service
    public function deposit($amount): Outputs {
        $result = new Outputs(); // my output
        $result->errorMessage = '';

        // validate 1. Amount must be numeric
        if(!preg_match('/^[0-9]*$/', $amount) || $amount == ''){
            $result->errorMessage = "Amount must be numeric!";
            
        } else if (strlen($this->accNo) != 10){ // validate 2. Account No. must have have 10 digit
            $result->errorMessage = "Account No. must have have 10 digit!";
            
        } else if (!preg_match('/^[0-9]*$/', $this->accNo)){ // validate 3. Account no. must be numeric
            $result->errorMessage = "Account no. must be numeric!";

        } else { // validate 4. Account no. must have existing            
            try{
                
                // Service Authentication
                if(self::$isTestAuthStub) {
                    $accountInfo = ServiceAuthenticationStub::accountAuthenticationProvider($this->accNo);
                } else {
                    $accountInfo = ServiceAuthentication::accountAuthenticationProvider($this->accNo);
                }

                // Deposit
                $accNo = $accountInfo["accNo"];
                $currentBal = $accountInfo["accBalance"] + $amount;
                if(self::$isTestTxStub) {
                    dbConnectorStub::saveTransaction($accNo, $currentBal);
                } else {
                    DBConnection::saveTransaction($accNo, $currentBal);
                }

                // Assign output
                $result->accountNumber = $accNo;
                $result->accountName = $accountInfo["accName"];
                $result->accountBalance = $currentBal;
                $billAmount = $accountInfo["accWaterCharge"] +  $accountInfo["accElectricCharge"] +  $accountInfo["accPhoneCharge"];
                $result->billAmount = $billAmount;
                // $result->isError = false;
            }
            catch(AccountInformationException $e){
                $result->errorMessage = $e->getMessage();

            }
        }
        return $result;
    }
 }