<?php

session_start();
        
require 'logic/router.php';
require 'logic/database.php';

/********** ROUTING **********/

if(isset($_GET["route"])){
    
    checkRoute($_GET["route"]);
    
}else{
    
    checkRoute("");
    
}