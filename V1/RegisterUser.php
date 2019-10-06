<?php
    require_once "../includes/DBOpertation.php";

    $response=array();

    if($_SERVER['REQUEST_METHOD']=='POST'){
        if(isset($_POST['Name']) and isset($_POST['Email']) and isset($_POST["ID"]) and isset($_POST['Password'])){
            $db=new DBOpertation();
            $result=$db->createUser(
                $_POST['ID'],
                $_POST['Name'],
                $_POST['Password'],
                $_POST['Email']);
            if($result==1){
                $response['error']=false;
                $response['message']="User register Successfully";
            }elseif ($result==2){
                $response['error']=true;
                $response['message']="Some error occurred please try again";
            }elseif ($result==0){
                $response['error']=true;
                $response['message']="user already exist";
            }
        }else{
            $response['error']=true;
            $response['message']="Required fields missing";
        }

    }else{
        $response['error']=true;
        $response['message']="invalid Request";

    }
    echo json_encode($response);
