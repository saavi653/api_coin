<?php
class validation
{
    function validate_user($data)
    {
        if(empty(trim($data['name']))||empty(trim($data['email']))||empty(trim($data['password'])))
        {
            echo"ERROR: All fields are mandatory";
            return 1;
        }
    }
    function validate_coin($data)
    {
        if(empty(trim($data)))
        {
            echo"ERROR:please enter the value";
            return 1;
        }
    }
}
?>