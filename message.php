<?php
    if( !isset($_POST['FirstName']) || !isset($_POST['LastName']) || !isset($_POST['Email']) || 
        !isset($_POST['Phone'])     || !isset($_POST['Message'])  || 
         empty($_POST['FirstName']) ||  empty($_POST['LastName']) ||  empty($_POST['Email']) ||  
         empty($_POST['Phone'])     ||  empty($_POST['Message']) ){
        
        header('Location: ' . dirname($_SERVER['REQUEST_URI']));
        exit(0);
    }

    
?>