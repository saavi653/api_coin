<?php
    include("controller.php");
    $obj=new controller();
    $data=$obj->hit();
    foreach($data['data'] as $key=>$value)
    {
        if($value['name']==$_SESSION['name'])
        {
            $price=$value['priceUsd'];
        }
    }
    $con=new connection();
    $con=$con->connection();
    $user_id=$_SESSION['login'];
    $coin_id=$_SESSION['name'];
    $buy= $_SESSION['buy'];
    $sell=$_SESSION['sell'];
    $add_money=$_SESSION['money'];
    if(!empty($add_money))
    {
        $money=$con->query("select wallet from user where id='$user_id'");
        $money=$money->fetch();
        $money=$money['wallet'];
        $money=$money + $add_money;
        $con->exec("update user set wallet='$money' where id='$user_id' ");
        header("location:des.php?name=".$coin_id);
    }
    if(!empty($buy))
    {
        $money=$con->query("select wallet from user where id='$user_id'");
        $money=$money->fetch();
        $money=$money['wallet'];
        $price=$price * $buy;
        if($money>$price)
        {
           $result=$con->query("select coins from commerce where user_id='$user_id' and coin_id='$coin_id' ");
           $result=$result->fetch();
           if(empty($result))
           {
                $con->query("insert into commerce values('$user_id','$coin_id','$buy')");
           }
            $result=$result['coins'];
            $total_coins=$result+$buy;
            $con->exec("update commerce set coins='$total_coins' where user_id='$user_id' and coin_id='$coin_id' ");
            $balance = $money - $price;
            $con->exec("update user set wallet='$balance' where id='$user_id' ");
            header("location:des.php?name=".$coin_id);
        } 
        else
        {
            header("location:index.php");
        }    
    }
    if(!empty($sell))
    {
        $coin=$con->query("select coins from commerce where user_id='$user_id' and coin_id='$coin_id'");
        $coin=$coin->fetch();
        $coin=$coin['coins'];
        if($coin >= $sell)
        { 
            $price=$sell * $price;
            $wallet=$con->query("select wallet from user where id='$user_id' ");
            $wallet=$wallet->fetch();
            $wallet=$wallet['wallet'];
            $new_wallet=$price+$wallet;
            $con->exec("update user set wallet='$new_wallet' where id='$user_id' ");
            $coin=$con->query("select coins from commerce where user_id='$user_id' and coin_id='$coin_id' ");
            $coin=$coin->fetch();
            $coin=$coin['coins'];
            $coin= $coin - $sell;
            $con->exec("update commerce set coins='$coin' where user_id='$user_id' and coin_id='$coin_id' ");
            header("location:des.php?name=".$coin_id);
        }
        else
        {
            header("location:index.php");
        }
    }
?>
