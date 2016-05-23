<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Request;
use App\Model\slots;
use DateTime;

class slotcontroller extends Controller
{

    public function createslot()
    {
        $data=Input::all();

        $email=$data["email"];
        $sdt=$data["sdt"];
        $edt=$data["edt"];
        $tz=$data["timezone"];

        $sdate=$this->ConvertLocalTimezoneToGMT($sdt,$tz);
        $edate=$this->ConvertLocalTimezoneToGMT($edt,$tz);
        $sdate1=date_create($sdate);
        $edate1=date_create($edate);

        $st=strtotime($sdt);
        $et=strtotime($edt);
        $m= round(abs($et - $st) / 60,2);
        
        $d=new slots();
        $res=$d->makeslot($email,$sdate,$edate,$m);
        $status="false";
        if($res=="")
        {
            $status="false";
        }
        else{

            $status="true";

        }
        $sdate2=$this->ConvertGMTToLocalTimezone($sdt,$tz);
        $edate2=$this->ConvertGMTToLocalTimezone($edt,$tz);

        return $res."$".$sdate2."#".$edate2;


    }

    public function deleteslot()
    {
        $data = Input::all();
        $slot_id = $data["slotid"];
        $timezone = $data["timezon"];
        $d=new slots();
        $res=$d->deleteslot($slot_id,$timezone);

        return $res;


    }

    public function removeslot()
    {
        $data = Input::all();
        $slot_id = $data["slotid"];
        $timezone = $data["timezon"];
        $d=new slots();
        $res=$d->cancelappointment($slot_id,$timezone);

        return $res;


    }

    public function updatestartsession()
    {

        $data=Input::all();
        $slotid=$data["slotid"];

        $d=new slots();
        $res=$d->updatestarttime($slotid);

        return $res;
    }

    public function updateendsession()
    {

        $data=Input::all();
        $slotid=$data["slotid"];

        $d=new slots();
        $res=$d->updateendtime($slotid);

        return redirect("coach");
    }
    public function updatesessionnotes()
    {

        $data=Input::all();
        $slotid=$data["slotid"];
        $notes=$data["notes"];
        $d=new slots();
        $res=$d->updatenotes($slotid, $notes);

        return $res;
    }

    public function updatesessionstatus()
    {
        $data=Input::all();
        $slotid=$data["slotid"];
        $d=new slots();
        $res=$d->updatestatus($slotid);

        return $res;
    }

   public function ConvertLocalTimezoneToGMT($gmttime, $timezoneRequired)
    {
        $system_timezone = date_default_timezone_get();

        $local_timezone = $timezoneRequired;
        date_default_timezone_set($local_timezone);
        $local = date("Y-m-d H:i:s");

        date_default_timezone_set("GMT");
        $gmt = date("Y-m-d H:i:s");

        date_default_timezone_set($system_timezone);
        $diff = (strtotime($gmt) - strtotime($local));

        $date = new DateTime($gmttime);
        $date->modify("+$diff seconds");

        //$timestamp = $date->format("Y-m-d");

        $timestamp = $date->format("Y-m-d H:i:s");
        return $timestamp;

        //return $date;

    }

   public function ConvertGMTToLocalTimezone($gmttime, $timezoneRequired)
    {
        $system_timezone = date_default_timezone_get();

        date_default_timezone_set("GMT");
        $gmt = date("Y-m-d H:i:s");

        $local_timezone = $timezoneRequired;
        date_default_timezone_set($local_timezone);
        $local = date("Y-m-d H:i:s");

        date_default_timezone_set($system_timezone);
        $diff = (strtotime($local) - strtotime($gmt));

        $date = new DateTime($gmttime);
        $date->modify("+$diff seconds");

        $timestamp = $date->format("Y-m-d H:i:s");
        return $timestamp;

        //return $date;
    }

}