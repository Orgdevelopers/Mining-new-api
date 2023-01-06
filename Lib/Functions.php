<?php

function ValidatePassword($password,$db_password,$email="")
{
    $password_hash = Utility::EncryptPassword($password);

    if($password_hash = $db_password){
        return true;
    }else{
        return false;
    }

}

?>