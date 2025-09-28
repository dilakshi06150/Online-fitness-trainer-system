<?php
    session_start();

    function isAuth(){
        if($_SESSION['user_id']){
            return true;
        }else{
            return false;
        }
    }

    function isLogged($role){
        if (isAuth()) {        
            if ($role != $_SESSION['role']) {
                header('Location:./unauthorized.php');
            }
        }else{
            header('Location:./login.php');
        }
    }











?>