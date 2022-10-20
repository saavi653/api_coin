<?php
class connection
{
    function connection()
    {
        $con=new pdo("mysql:host=localhost;dbname=coin;","root","");
        return $con;
    }
}
?>