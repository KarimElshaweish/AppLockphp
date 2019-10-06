<?php
    require_once "../includes/DBOpertation.php";
    $response=array();
    if($_SERVER["REQUEST_METHOD"]=='POST'){
        if( isset($_POST['Email']) and isset($_POST['Password'])){
            $db=new DBOpertation();
            if($db->userLogin($_POST['Email'],$_POST['Password'])){
                $ID=$db->getUserID($_POST['Email']);
                $response['error']=false;
                $response['ID']="error";

            }else{
                $response['error']=true;
                $response['message']="wrong Email and password";
            }
        }else{
            $response["Name"]=$_POST['Email'];
            $response['Password']=$_POST['Password'];
            $response['error']=true;
            $response['message']="Some fields are missing";
        }
    }else{
        $response['error']=true;
        $response['message']="invalid Request";
    }
    echo json_encode($response);
