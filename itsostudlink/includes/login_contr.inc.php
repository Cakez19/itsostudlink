<?php
function is_inputs_empty( $username,  $password){

    if(empty($username)|| empty($password)){
        return true;
    }else{
        return false;
    }
}

function is_username_wrong($result){

    if(!$result){
        return true;
    }else{
        return false;
    }
}


function is_password_wrong( $password,  $hashedPassword){

    if(!password_verify($password, $hashedPassword)){
        return true;
    }else{
        return false;
    }
}




