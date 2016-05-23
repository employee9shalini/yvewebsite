<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Request;
use App\Model\actions;

class actionscontroller extends Controller
{
    public function deletecoach()
{
    $data = Input::all();

    $email_id = $data["email_id"];

    $u = new actions();
    $status = $u->deletecoach($email_id);
    return $status;

}

    public function deleteclient()
    {
        $data = Input::all();

        $email_id = $data["email_id"];

        $u = new actions();
       // $status = $u->deleteclient($email_id);
        return $email_id;

    }

    public function activatecoach()
    {
        $data = Input::all();

        $email_id = $data["email_id"];

        $u = new actions();
        $status = $u->activatecoach($email_id);
        return $status;

    }

    public function inactivatecoach()
    {
        $data = Input::all();

        $email_id = $data["email_id"];

        $u = new actions();
        $status = $u->inactivatecoach($email_id);
        return $status;

    }


}