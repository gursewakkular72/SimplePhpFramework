<?php

namespace Core; 

/**
 * Base controller
 *
 * PHP version 5.4
 */

 abstract class Controller {
    
      /**
     * Parameters from the matched route
     * @var array
     */
    protected $params = []; 
     /**
     * Class constructor
     *
     * @param array $route_params  Parameters from the route
     *
     * @return void
     */
    public function  __construc($params) {
        $this->params = $params; 
    }


    public function __call($name, $args ) {

       // code ran before method 
       $name = $name.'Action';

       call_user_func_array([$this, $name], $args); 

       // code ran afer 


    }

  

   


}


    
   

   
   

