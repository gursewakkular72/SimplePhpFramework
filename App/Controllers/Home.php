<?php 

namespace App\Controllers; 



/**
 * Home controller;
 * 
 * 
 */
 class Home extends \Core\Controller {



/**
 * show the index page
 * 
 * @return void
 */

    public function indexAction(){
        echo "Hello from the index action of Home Controller.";
        echo "<pre?> Query Parameters: ".
        htmlspecialchars(print_r($_GET,true)).'</pre>';

       
       
    }
}


?>