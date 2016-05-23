<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Request;
use App\Model\loaddata;

class loaddatacontroller extends Controller
{

    public function getallcoaches()

    {
        $d=new loaddata();
        $data=$d->getcoachdata();
        return $data;

    }

    public function getallclients()

{
    $data=Input::all();
    $email=$data["qemail"];
    $d=new loaddata();
    $data=$d->getclientdata($email);
    return $data;

}

    public function getallcorpclients()

    {
        $data=Input::all();
        $email=$data["email1"];
        $d=new loaddata();
        $data=$d->getallcorpclientdata($email);
        return $data;

    }

    public function getallcompanies()

    {
        $data=Input::all();
        $d=new loaddata();
       $data=$d->getcompanydata();
        return $data;

    }

    public function getallclientsbyadmin()

    {
        $d=new loaddata();
       $data=$d->getclientdatabyadmin();
        return $data;

    }

    public function getcompanyprofile()

    {
        $d=new loaddata();
        $data=Input::all();
        $uid=$data["userid"];
        $data=$d->getcompanyprofile($uid);
        return $data;

    }

    public function getfavcoaches()

    {
        $data=Input::all();
        $cid=$data["cid"];
        $d=new loaddata();
        $data=$d->getfavcoachdata($cid);
        return $data;

    }

    public function getclientprofile()

    {
        $data=Input::all();
        $uid=$data["userid"];
        $d=new loaddata();
        $d1=$d->getclientprofile($uid);
        return $d1;

    }

    public function getcorpclientprofile()

    {
        $data=Input::all();
        $uid=$data["userid"];
        $d=new loaddata();
        $d1=$d->getcorpclientprofile($uid);
        return $d1;

    }

    public function getcoachprofile()

    {
        $data=Input::all();
        $email=$data["emailid"];
        $d=new loaddata();
        $d1=$d->getprdata($email);
        return $d1;

    }

    public function getappointdata()

    {
        $d=new loaddata();
       $d1=$d->getappointdata();
        return $d1;

    }

    public function getcatlist()

    {
        $d=new loaddata();
        $data=$d->getcategories();
        return $data;

    }

    public function getlanglist()

    {
        $d=new loaddata();
        $data=$d->getlanguages();
        return $data;

    }

    public function getprofileimg()

{
    $data=Input::all();
    $email=$data["qemail"];
    //$email='harvinder.kaur@agicent.com';
    $d=new loaddata();
    $data=$d->getprimg($email);
    return $data;

}



    public function getprofiledata()

    {
        $data=Input::all();
        $email=$data["qemail"];
        //$email='harvinder.kaur@agicent.com';
        $d=new loaddata();
        $data=$d->getprdata($email);
        return $data;

    }

    public function getreviewdata()

    {
        $data=Input::all();
        $email=$data["qemail"];
        //$email='harvinder.kaur@agicent.com';
        $d=new loaddata();
        $data1=$d->getreviews($email);
        return $data1;

    }

    public function getclientreviewdata()

    {
        $data=Input::all();
        $email=$data["email"];
        $d=new loaddata();
        $data1=$d->getclientreviews($email);
        return $data1;

    }

    public function getfinancedata()

{
    $data=Input::all();
    $email=$data["qemail"];
    //$email='harvinder.kaur@agicent.com';
    $d=new loaddata();
    $data=$d->getfinancialdetails($email);
    return $data;

}

    public function getallfinancedata()

    {
        $data=Input::all();

        $d=new loaddata();
        $status=$d->getallfinancialdetails();

        return $status;

    }

    public function getfinancedata2()

    {
        $data=Input::all();
        $email=$data["qemail"];
        //$email='harvinder.kaur@agicent.com';
        $d=new loaddata();
        $data=$d->getfinancialdetails2($email);
        return $data;

    }


    public function getcostpermonth()

    {
        $data=Input::all();
        $email=$data["qemail"];
        //$email='harvinder.kaur@agicent.com';
        $d=new loaddata();
       $dat=$d->getcost($email);
        return $dat;

    }

    public function getcostpermonth2()

    {
        $data=Input::all();
        $email=$data["qemail"];
        //$email='harvinder.kaur@agicent.com';
        $d=new loaddata();
       $dat=$d->getcost2($email);
        return $dat;

    }

    public function gettimelinedata()

    {
        $data=Input::all();
        $coach_email=$data["qemail"];
        $client_email=$data["cemail"];
        $d=new loaddata();
        $fdata=$d->gettimelinedetails($coach_email,$client_email);
        return $fdata;

    }


    public function gettimelinedata2()

    {
        $data=Input::all();

        $client_email=$data["cemail"];
        $d=new loaddata();
       $fdata=$d->gettimelinedetails2($client_email);
        return $fdata;

    }


    public function getslots()

    {
        $data=Input::all();
        $email=$data["qemail"];
        $timezone=$data["timezon"];
        //$email='harvinder.kaur@agicent.com';
        $d=new loaddata();
        $data=$d->getslotinfo($email,$timezone);
        return $data;

    }

    public function getslotsbyclient()

{
    $data=Input::all();
    $email=$data["qemail"];
    $timezone=$data["timezon"];
    //$email='harvinder.kaur@agicent.com';
    $d=new loaddata();
    $data=$d->getslotinfobyclient($email,$timezone);
    return  $data;

}

    public function getslottime()

    {
        $data=Input::all();
        $slotid=$data["slotid"];
$timezone=$data["timezon"];
        $d=new loaddata();
        $data=$d->getslottime($slotid,$timezone);
        return  $data;

    }

    public function getcoaches()

{
    $data=Input::all();
    $d=new loaddata();
    $data=$d->getcoaches();
    return $data;

}

    public function getcompanies()

    {
        $data=Input::all();
        $d=new loaddata();
        $data=$d->getcompanies();
        return $data;

    }

    public function getdclientdata()

    {
        $data=Input::all();
        $d=new loaddata();
        $data=$d->getdclientdata();
        return $data;

    }

    public function getcorpclientdata()
    {
        $data=Input::all();
        $email=$data["email1"];
        $data=Input::all();
        $d=new loaddata();
        $data=$d->getcorpclientdata($email);
        return $data;

    }


    public function getclient()

    {
        $data=Input::all();
        $d=new loaddata();
        $data=$d->getclients();
        return $data;

    }

    public function getactivecoaches()

    {
        $data=Input::all();
        $d=new loaddata();
       $status=$d->getactivecoaches();
        return $status;

    }

    public function getactiveclients()

    {
        $data=Input::all();
        $d=new loaddata();
        $status=$d->getactiveclients();
        return $status;

    }

    public function getactivecorpclients()

    {
        $data=Input::all();
        $email=$data["email1"];
        $d=new loaddata();
        $status=$d->getactivecorpclients($email);
        return $status;

    }

    public function getcreditoverview()
    {
        $data=Input::all();
        $email=$data["email"];
        $d=new loaddata();
        $status=$d->getcreditoverview($email);
        return $status;

    }

    public function getcreditoverview2()
    {
        $data=Input::all();
        $timezone=$data["timezon"];
        $d=new loaddata();
        $status=$d->getcreditoverview2($timezone);
        return $status;

    }


    public function getinactivecorpclients()

    {
        $data=Input::all();
        $email=$data["email1"];
        $d=new loaddata();
        $status=$d->getinactivecorpclients($email);
        return $status;

    }

    public function getavailablecredits()

    {
        $data=Input::all();
        $comp_email=$data["email1"];
        $d=new loaddata();
        $data=$d->getavailablecredits($comp_email);
        return $data;

    }

    public function bindcorpclientname()

{
    $data=Input::all();
    $email=$data["email"];
    $d=new loaddata();
    $status=$d->bindcorpclientname($email);
    return $status;

}


    public function bindcompanyname()

    {
        $data=Input::all();

        $d=new loaddata();
        $status=$d->bindcompanyname();
        return $status;

    }

    public function getinactivecoaches()

    {
        $data=Input::all();

        $d=new loaddata();
        $status=$d->getinactivecoaches();
        return $status;

    }



}