<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Model\loaddata;
//use app/config/database.php;
class credit extends Model
{


    public function creditdistribution($companyemail,$client_id,$credit_qty)
    {
        $d=new loaddata();
        $comp_id=$d->getuserid($companyemail);

        $res= DB::table('credit_available')->select('credit_available_qty')->where('user_id', $comp_id)->first();

        $company_available_credit=$res->credit_available_qty;
        $status = '';


        if($credit_qty<=$company_available_credit)
        {
            $balance=(int)$company_available_credit-(int)$credit_qty;
            $result = DB::table('credit_available')->where('user_id',$comp_id)
                ->update(array('credit_available_qty' => $balance

                ));

            date_default_timezone_set('UTC');
            $date = date('Y-m-d H:i:s');

            $result2 = DB::table('client_credit_distribute')->insert(
                array('credit_distribute_id' => '',
                    'company_user_id' => $comp_id,
                    'client_user_id' => $client_id,
                    'credit_qty' => $credit_qty,
                    'date_created' => $date

                )
            );

            $res2= DB::table('credit_available')->select('credit_available_qty')->where('user_id', $client_id)->first();
            $client_available_qty='0';
            if($res2)
            {
                $client_available_qty=$res2->credit_available_qty;

            }
            $client_qty=(int)$client_available_qty+(int)$credit_qty;
if($client_available_qty==0)
{
    $result3 = DB::table('credit_available')->insert(
        array('credit_available_id' => '',
            'user_id' => $client_id,
            'credit_available_qty' => $client_qty

        )
    );
}
            else
            {

                $result = DB::table('credit_available')->where('user_id',$client_id)
                    ->update(array('credit_available_qty' => $client_qty

                    ));

            }




            $status = "true";


        }
        else
        {
            $status = "false";
        }
        return $status;


    }

    public function creditdistribution2($company_id,$credit_qty)
    {

        date_default_timezone_set('UTC');
        $date = date('Y-m-d H:i:s');

        $result2 = DB::table('company_credit_distribute')->insert(
            array('credit_distribute_id' => '',
                'company_user_id' => $company_id,
                'credit_qty' => $credit_qty,
                'date_created' => $date

            )
        );


        $res2= DB::table('credit_available')->select('credit_available_qty')->where('user_id', $company_id)->first();
        $comp_available_qty='0';
        if($res2)
        {
            $comp_available_qty=$res2->credit_available_qty;

        }
        $comp_qty=(int)$comp_available_qty+(int)$credit_qty;
        if($comp_available_qty==0)
        {
            $result3 = DB::table('credit_available')->insert(
                array('credit_available_id' => '',
                    'user_id' => $company_id,
                    'credit_available_qty' => $comp_qty

                )
            );
        }
        else
        {

            $result = DB::table('credit_available')->where('user_id',$company_id)
                ->update(array('credit_available_qty' => $comp_qty

                ));

        }
        return "true";
    }
}


