<?php namespace Operation;

require_once __DIR__ . './../serviceauthentication/DBConnection.php';
require_once __DIR__ . './../serviceauthentication/serviceauthentication.php';

use AccountInformationException;
use DBConnection;
use ServiceAuthentication;

class Withdrawal
{
    private $session;

    public function __construct(string $session)
    {
        $this->session = $session;
    }

    public function withdraw(int $withDrawamount): array
    {
        $response = array("isError" => true);
        if (!preg_match('/^[0-9]*$/', $this->session) || !preg_match('/^[0-9]*$/', $withDrawamount)) {
            $response["message"] = "Account no. and Amount must be numeric!";
        } elseif (strlen($this->session) != 10) {
            $response["message"] = "Account no. must have 10 digit!";
        } else {
            try {
                $result = ServiceAuthentication::accountAuthenticationProvider($this->session);
                $accBalance = (int) $result["accBalance"];
                if ($withDrawamount > $accBalance) {
                    $response["message"] = "Not Enough money";
                } else {
                    $updatedBalance = $accBalance - $withDrawamount;
                    DBConnection::saveTransaction($this->session, $updatedBalance);
                    $response["updatedBalance"] = $updatedBalance;
                    $response["isError"] = false;
                }

            } catch (AccountInformationException $e) {
                $response["message"] = $e->getMessage();
            } catch (Exception $e) {
                $response["message"] = "Unknown error occurs in Authentication";
            } catch (Error $e) {
                $response["message"] = "Unknown error occurs in Authentication";
            }
        }

        return $response;
    }

}
