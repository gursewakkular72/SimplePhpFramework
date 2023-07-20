<?php 

namespace App\Controllers; 


/**
 * Home controller;
 * 
 * 
 */
class Home {



/**
 * show the index page
 * 
 * @return void
 */

    public function index(){
        echo "Hello from the index action of Home Controller.";
        echo "<pre?> Query Parameters: ".
        htmlspecialchars(print_r($_GET,true)).'</pre>';

       
       
    }
}


?>