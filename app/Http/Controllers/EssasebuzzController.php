<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Easebuzz\Easebuzz;

class EssasebuzzController extends Controller
{

    public function index()
    {
        //
    }

    public function store(Request $request)
    {

        // include file

        /*
    * Create object for call easepay payment gate API and Pass required data into constructor.
    * Get API response.
    *  
    * param string $_GET['apiname'] - holds the API name.
    * param  string $MERCHANT_KEY - holds the merchant key.
    * param  string $SALT - holds the merchant salt key.
    * param  string $ENV - holds the env(enviroment).
    * param  string $_POST - holds the form data.
    *
    * ##Return values
    *   
    * - return array ApiResponse['status']== 1 successful.
    * - return array ApiResponse['status']== 0 error.
    *
    * @param string $_GET['apiname'] - holds the API name.
    * @param  string $MERCHANT_KEY - holds the merchant key.
    * @param  string $SALT - holds the merchant salt key.
    * @param  string $ENV - holds the env(enviroment).
    * @param  string $_POST - holds the form data.
    *
    * @return array ApiResponse['status']== 1 successful. 
    * @return array ApiResponse['status']== 0 error. 
    *
    */
        if (!empty($_POST) && (sizeof($_POST) > 0)) {

            /*
        * There are three approch to call easebuzz API.
        *
        * 1. using hidden api_name which is $_POST from form.
        * 2. using pass api_name into URL.
        * 3. using extract html file name then based on file name call API.
        *
        */

            // first way
            // $apiname = trim(htmlentities($_POST['api_name'], ENT_QUOTES));

            // second way
            $apiname = 'initiate_payment';

            // third way
            // $url_link = $_SERVER['HTTP_REFERER'];
            // $apiname = explode('.', ( end( explode( '/',$url_link) ) ) )[0];
            // $apiname = trim(htmlentities($apiname, ENT_QUOTES));

            /*
        * Based on API call change the Merchant key and salt key for testing(initiate payment).
        */

            $MERCHANT_KEY = "merchant key";
            $SALT = "salt key";
            // $ENV = "test";    // setup test enviroment (testpay.easebuzz.in).
            $ENV = "prod";   // setup production enviroment (pay.easebuzz.in).

            $easebuzzObj = new Easebuzz($MERCHANT_KEY, $SALT, $ENV);

            if ($apiname === "initiate_payment") {

                /*  Very Important Notes
            * 
            * Post Data should be below format.
            *
                Array ( [txnid] => T3SAT0B5OL [amount] => 100.0 [firstname] => jitendra [email] => test@gmail.com [phone] => 1231231235 [productinfo] => Laptop [surl] => http://localhost:3000/response.php [furl] => http://localhost:3000/response.php [udf1] => aaaa [udf2] => aa [udf3] => aaaa [udf4] => aaaa [udf5] => aaaa [address1] => aaaa [address2] => aaaa [city] => aaaa [state] => aaaa [country] => aaaa [zipcode] => 123123 ) 
            */

                $result = $easebuzzObj->initiatePaymentAPI($_POST);

                print_r($result);
            } else if ($apiname === "transaction") {

                /*  Very Important Notes
            * 
            * Post Data should be below format.
            *
                Array ( [txnid] => TZIF0SS24C [amount] => 1.03 [email] => test@gmail.com [phone] => 1231231235 )
            */
                $result = $easebuzzObj->transactionAPI($_POST);

                print_r($result);
            } else if ($apiname === "transaction_date" || $apiname === "transaction_date_api") {

                /*  Very Important Notes
            * 
            * Post Data should be below format.
            *
                Array ( [merchant_email] => jitendra@gmail.com [transaction_date] => 06-06-2018 )
            */
                $result = $easebuzzObj->transactionDateAPI($_POST);

                print_r($result);
            } else if ($apiname === "refund") {

                /*  Very Important Notes
            * 
            * Post Data should be below format.
            *
                Array ( [txnid] => ASD20088 [refund_amount] => 1.03 [phone] => 1231231235 [email] => test@gmail.com [amount] => 1.03 )
            */
                $result = $easebuzzObj->refundAPI($_POST);

                print_r($result);
            } else if ($apiname === "payout") {

                /*  Very Important Notes
            * 
            * Post Data should be below format.
            *
               Array ( [merchant_email] => jitendra@gmail.com [payout_date] => 08-06-2018 )
            */
                $result = $easebuzzObj->payoutAPI($_POST);

                print_r($result);
            } else {

                echo '<h1>You called wrong API, Pleae try again</h1>';
            }
        } else {
            echo '<h1>Please fill all mandatory fields.</h1>';
        }
    }
    public function response2(Request $request)
    {

        // salt for testing env
        $SALT = "your salt key";

        /*
    * Get the API response and verify response is correct or not.
    *
    * params string $easebuzzObj - holds the object of Easebuzz class.
    * params array $_POST - holds the API response array.
    * params string $SALT - holds the merchant salt key.
    * params array $result - holds the API response array after valification of API response.
    *
    * ##Return values
    *
    * - return array $result - hoids API response after varification.
    * 
    * @params string $easebuzzObj - holds the object of Easebuzz class.
    * @params array $_POST - holds the API response array.
    * @params string $SALT - holds the merchant salt key.
    * @params array $result - holds the API response array after valification of API response.
    *
    * @return array $result - hoids API response after varification.
    *
    */
        $easebuzzObj = new Easebuzz($MERCHANT_KEY = null, $SALT, $ENV = null);

        $result = $easebuzzObj->easebuzzResponse($_POST);
        echo "<pre>";
        print_r($result);
    }
}
