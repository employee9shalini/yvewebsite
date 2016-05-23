<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
require_once('stripe/init.php');
require_once('stripe/lib/Stripe.php');
//use app/config/database.php;
class payment extends Model
{

    public function getcardinfo($user_id)
    {
        $res = DB::table('card_info')->select('card_id','card_number','expiry_date','cvv_number')->where('user_id', $user_id)->where('default_flag', '1')->first();

        $card_number='';
        $exp_date='';
        $cvv_no='';
        $card_id='';

        if($res) {

            $card_id=$res->card_id;
            $card_number=$res->card_number;
            $exp_date=$res->expiry_date;
            $cvv_no=$res->cvv_number;

        }

        return $card_id."#".$card_number . "#" . $exp_date . "#" . $cvv_no;
    }

    public function deduct_payment($coach_id,$uid,$slot_id)
    {
        $client_type_id='';
        $amount='';
        $name='';

       // $l=new loaddata();
      //  $n= $l->getuserdata($uid);

       // $narr=explode("#",$n);
       // $name=$narr[0];
        $payment_method_id='';
        $session_id='';

        date_default_timezone_set('UTC');

        $date= date('Y-m-d H:i:s');
        $credit_value = '20';

        $res = DB::table('users')->select('user_type_id','default_payment_method')->where('user_id', $uid)->where('approval_flag', '1')->first();

        if($res) {

            $user_type_id=$res->user_type_id;
            $payment_method_id=$res->default_payment_method;
        }

        $res1 = DB::table('sessions')->select('session_id')->where('slot_id', $slot_id)->first();

        if($res1) {

            $session_id=$res1->session_id;

        }

        $res2 = DB::table('users')->select('level_id')->where('user_id', $coach_id)->where('approval_flag', '1')->first();

        $level_id = '1';

        if ($res2) {

            $level_id = $res2->level_id;
        }


        if($user_type_id=='1' && $payment_method_id=='1') {




            $amount = (int)$credit_value * (int)$level_id;
           $cardinfo=$this->getcardinfo($uid);

            $arr=explode("#",$cardinfo);
            $card_id=$arr[0];
            //$exp_date=$arr[1];
            //$cvv_no=$arr[2];
            //$exparr=explode("/",$exp_date);

            //$yr=$exparr[1];
            //$month=$exparr[0];

            $card_number="4242 4242 4242 4242";
            $cvv_no="123";
            $yr="17";
            $month="02";


            \Stripe\Stripe::setApiKey("sk_test_iWunbulLUd5S1fr01Fthvcqe");
            $stripeToken ='';
            $stripeToken =  \Stripe\Token::create(
                array(
                    "card" => array(
                        "name" =>$name,
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


                if (isset($_SESSION['token']) && ($_SESSION['token'] == $token)) {
                    $errors['token'] = 'You have apparently resubmitted the form. Please do not do that.';
                } else { // New submission.
                    $_SESSION['token'] = $token;
                }

            } else {
                $errors['token'] = 'The order cannot be processed. Please make sure you have JavaScript enabled and try again.';
            }

            if (empty($errors)) {

                try {
$amount1=(int)$amount*100;



                    $charge = \Stripe\Charge::create(array(
                            "amount" => $amount1, // amount in cents, again
                            "currency" => "usd",
                            "card" => $token,
                            "description" => $name
                        )
                    );

                    // Check that it was paid:
                    if ($charge->paid == true) {

                        $charge_json = $charge->__toJSON();


                        $trans_id= $charge->id;

                        $trans_status=$charge->status;

                        $status='';

                        if($trans_status=='succeeded')
                        {
                            $status='S';
                        }

                        else
                        {
                            $status='F';
                        }



                        $result = DB::table('payments')->insert(
                            array('transaction_id' => '',
                                'client_user_id' => $uid,
                                'session_id' => $session_id,
                                'payment_method_id' => $payment_method_id,
                                'card_id' => $card_id,
                                'amount' => $amount,
                                'currency_type' => 'usd',
                                'payment_date'=> $date,
                                'payment_status'=> $status,
                                'coach_user_id' => $coach_id,
                                'stripe_transaction_id' => $trans_id

                            ));


                        //echo $charge_json->status;
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

        }

        if($user_type_id=='4') {
echo $credit_value;
            $credit_qty = $level_id;
            $res3 = DB::table('credit_available')->select('credit_available_qty')->where('user_id', $uid)->first();
            $credit_available_qty=0;
            $amount = (int)$credit_value * (int)$credit_qty;

            if($res3)
            {
                $credit_available_qty=$res3->credit_available_qty;

            }

            if($credit_available_qty>=$credit_qty)
            {
                $balance_qty=(int)$credit_available_qty-(int)$credit_qty;

                $result= DB::table('credit_available')->where('user_id', $uid )
                    ->update(array('credit_available_qty' => $balance_qty

                    ));

                if ($result) {
                    $status = "true";
                    $result = DB::table('payments')->insert(
                        array('transaction_id' => '',
                            'client_user_id' => $uid,
                            'session_id' => $session_id,
                            'payment_method_id' => '3',
                            'credit_qty' => $credit_qty,
                            'amount' => $amount,
                            'currency_type' => 'usd',
                            'payment_date'=> $date,
                            'payment_status'=> 'S',
                            'coach_user_id' => $coach_id,


                        ));
                } else {
                    $status = "false";
                }

            }



        }

echo 'j';
    }


}


