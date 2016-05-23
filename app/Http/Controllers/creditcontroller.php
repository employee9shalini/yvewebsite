<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Request;
use App\Model\credit;

class creditcontroller extends Controller
{
    public function distributecredit()

    {
        $data=Input::all();
        $client_id=$data["clientid"];
        $credit_qty=$data["creditqty"];
        $companyemail=$data["email"];
        $d=new credit();
      $status=$d->creditdistribution($companyemail,$client_id,$credit_qty);
        return $status;

    }

    public function distributecredit2()

    {
        $data=Input::all();
        $comp_id=$data["compid"];
        $credit_qty=$data["creditqty"];

        $d=new credit();
        $status=$d->creditdistribution2($comp_id,$credit_qty);
        return $status;

    }


}