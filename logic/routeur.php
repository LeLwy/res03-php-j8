<?php

function checkRoute(string $route) : void 
{
    if($route === "connexion"){
        
        require 'pages/login.php';
        
    }else if($route === "creer-un-compte"){
        
        require 'pages/register.php';
        
    }else if($route === "admin-posts"){
        
        require 'pages/admin/post.php';
        
    }else if($route === "admin-categories"){
        
        require 'pages/admin/post-category.php';
        
    }else{
        
        require 'pages/homepage.php';
        
    }
}

?>