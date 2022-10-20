<?php
session_start();
include("conn.php");
include("validation.php");
class controller
{
    public function hit()
    {
        $ch = curl_init();
        curl_setopt_array($ch, [CURLOPT_URL => "https://api.coincap.io/v2/assets", CURLOPT_RETURNTRANSFER => TRUE]);
        $response = curl_exec($ch);
        $error = curl_error($ch);
        if ($error) 
        {
            echo "$error";
        }
        curl_close($ch);
        $response = json_decode($response, true);
        return $response;
    }
    function search($search)
    {
        $response=$this->hit();
        foreach($response['data'] as $key=>$value)
        {
            if($value['name']==$search)
            {
                header("location:des.php?name=".$search);
            }
        }    
    }
    function signup($data)
    {
        $obj=new validation();
        $error=$obj->validate_user($data);
        if($error==0)
        {
            $name=$data['name'];
            $email=$data['email'];
            $pass=$data['password'];
            $obj=new connection();
            $data=$obj->connection();
            $data->query("insert into user(name,email,password)values('$name','$email','$pass')");
        }
    }
    function login($data)
    {
        $email=$data['email'];
        $pass=$data['password'];
        $obj=new connection();
        $con=$obj->connection();
        $exe=$con->query("select id,email,password from user where email='$email' and password='$pass' ");
        $user=$exe->fetch();
        if(!empty($user))
        {
            $_SESSION['login']=$user['id'];
            header('location:index.php');
        }
        else
        {
            echo"ERROR:invalid data";
        }
    } 
}
?>