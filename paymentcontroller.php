<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Request;
use App\Model\payment;
use App\Model\loaddata;
require_once('stripe/init.php');
require_once('stripe/lib/Stripe.php');
class paymentcontroller extends Controller
{

    public function charge()

    {
        $data = Input::all();

        $uid = $data["tempuid"];
        $d=new payment();
        $cardinfo=$d->getcardinfo($uid);

        $arr=explode("#",$cardinfo);
        $card_number=$arr[0];
        $exp_date=$arr[1];
        $cvv_no=$arr[2];
        $exparr=explode("/",$exp_date);
        $yr=$exparr[1];
        $month=$exparr[0];
echo $exparr;
        $l=new loaddata();
       $n= $l->getuserdata($uid);

        $narr=explode("#",$n);
        $name=$narr[0];
        \Stripe\Stripe::setApiKey("sk_test_iWunbulLUd5S1fr01Fthvcqe");
        $stripeToken ='';
        $stripeToken =  \Stripe\Token::create(
            array(
                "card" => array(
                    "name" =>'',
                    "number" => $card_number,
                    "exp_month" => $month,
                    "exp_year" => $yr,
                    "cvc" =>$cvv_no
                )
            )
        );



// Need a payment token:
        if ($stripeToken!='') {

            $token = $stripeToken;

            // Check for a duplicate submission, just in case:
            // Uses sessions, you could use a cookie instead.
            if (isset($_SESSION['token']) && ($_SESSION['token'] == $token)) {
                $errors['token'] = 'You have apparently resubmitted the form. Please do not do that.';
            } else { // New submission.
                $_SESSION['token'] = $token;
            }

        } else {
            $errors['token'] = 'The order cannot be processed. Please make sure you have JavaScript enabled and try again.';
        }

// Set the order amount somehow:
        $amount = 2000; // $20, in cents

// Validate other form data!

// If no errors, process the order:
        if (empty($errors)) {

            // create the charge on Stripe's servers - this will charge the user's card
            try {



                // Include the Stripe library:
                // Assumes you've installed the Stripe PHP library using Composer!
                //require_once('vendor/autoload.php');

                // set your secret key: remember to change this to your live secret key in production
                // see your keys here https://manage.stripe.com/account


                // Charge the order:
                $charge = \Stripe\Charge::create(array(
                        "amount" => $amount, // amount in cents, again
                        "currency" => "usd",
                        "source" => $token,
                        "description" => $name
                    )
                );

                // Check that it was paid:
                if ($charge->paid == true) {
                    echo $name;
                    //echo $_POST['stripeEmail'];
                    // Store the order in the database.
                    // Send the email.
                    // Celebrate!

                } else { // Charge was not paid!
                    echo '<div class="alert alert-error"><h4>Payment System Error!</h4>Your payment could NOT be processed (i.e., you have not been charged) because the payment system rejected the transaction. You can try again or use another card.</div>';
                }

            } catch (\Stripe\Error\Card $e) {
                // Card was declined.
                $e_json = $e->getJsonBody();
                $err = $e_json['error'];
                $errors['stripe'] = $err['message'];
            } catch (\Stripe\Error\ApiConnection $e) {
                // Network problem, perhaps try again.
            } catch (\Stripe\Error\InvalidRequest $e) {
                // You screwed up in your programming. Shouldn't happen!
            } catch (\Stripe\Error\Api $e) {
                // Stripe's servers are down!
            } catch (\Stripe\Error\Base $e) {
                // Something else that's not the customer's fault.
            }

        }
        return View("coach");

    }


}