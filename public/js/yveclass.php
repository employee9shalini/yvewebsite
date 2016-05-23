<?php


class yveclass

{
    public function checkuser($email,$pwd)
    {
        $q="select user_type_id from users where user_eid='".$email."' and user_pwd='".$pwd."';";
        $result=mysqli_query(GetMyConnection(),$q);
        $row=mysqli_fetch_row($result);
        $type=$row[0];
        return $type;

    }

    public function getcatlist()
    {

        $q="select * from coach_categories";
        //$result=mysql_query($q,GetMyConnection());
        $result=mysqli_query(GetMyConnection(),$q);
        $list='';
        $list1='';
        //while($row=mysql_fetch_array($result))
        while($row=mysqli_fetch_array($result))
        {

            $list=$list."<option value=".$row[0].">".$row[1]."</option>";
        }

if($list!='')
{
    $list1="<option value='-Select-'>-Select-</option>".$list;
}

        return $list;


    }

    public function checkfuser($email)
    {
        $status='';
        $q="select user_contact,user_fname,user_lname,user_type_id from users where user_eid='".$email."';";
        $result=mysqli_query(GetMyConnection(),$q);
        $row=mysqli_fetch_row($result);
        $name=$row[1];
        $contact=$row[0];
        $type=$row[2];
        if($name=='') {
            $status = "false"."#";
        }

        else
        {
            $status = "true".  "#" . $type;
        }
        return $status;

    }

    public function updatefbid($email,$fbid)
    {
        $q="update users set user_fbid='".$fbid."' where user_eid='".$email."';";
        $result=mysqli_query(GetMyConnection(),$q);
        $status='';
        return $q;
    }

    public function registeruser($email,$fname,$lname,$pwd,$typeid,$contact,$company,$adr,$place,$cperson,$cmpnumber,$vat,$fbid,$twid,$catid)
    {
        $q="insert into users(user_eid,user_pwd,user_type_id,user_fname,user_lname,user_contact,user_company,user_addr,user_place,user_cntperson,user_cmp_number,user_vat,user_fbid,user_twid,user_catid)values ('".$email."','".$pwd."','".$typeid."','".$fname."','".$lname."','".$contact."','".$company."','".$adr."','".$place."','".$cperson."','".$cmpnumber."','".$vat."','".$fbid."','".$twid."','".$catid."')";
        $result=mysqli_query(GetMyConnection(),$q);
        //$result=mysql_query($q,GetMyConnection());
        $status="";
        if($result)
       {
           $status="true";
       }
        else
        {
            $status="false";
        }

        return $status;

    }

}

?>