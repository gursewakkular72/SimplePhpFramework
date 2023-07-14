<?php 

class Router {
    /**
     * Associative array of routes, the routing table
     * @var array
     */

     // eg [
    //  "/" : [controller: 'home', action: 'show']
    // ]
     protected $routes = []; 

    /**
     * Parameter from the matched routes
     * 
     */

     protected $matchedParams = [];

    /**
     * Adding a route to the routing table
     * 
     * @param string $route: The rotue URL
     * @param array $params Parameters (controller, action, etc.) 
     * 
     * @return void
     * 
     * 
     */

     public function add($route, $params=[]) {
       $route = preg_replace('/\//', '\\/', $route); 
       $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route); 
       $route = preg_replace('/\{([a-z-]+):([^\}]+)\}/', '(?P<\1>\2)', $route);
       echo $route. ' route'; 
       $route = '/^'.$route.'$/i';
       $this->routes[$route] = $params;   
     }

     /**
      * Match the route to the routes in the routing table, setting the $matchedParams property
      *if the route is found. 
      * 
      * @params string $url: The route URL
      *
      *@return boolean true if a match found, false otherwise. 
      */

    public function match($url) {
      foreach ($this->routes as $route => $params) {

        if(preg_match($route, $url, $matches)) {
          // echo $route;
          foreach($matches as $val=>$match){
            if(is_string($val)) {
               $params[$val] = $match; 
      
            }
          }
          $this->matchedParams = $params;

          return true; 
        }

        
      }      

      return false; 

    }


     /**
      * Get all the routes from the routing table
      * @return array
      */

      public function getRoutes() {

        return $this->routes; 
      }

      /**
       * Get the currenlty matched params
       * 
       */

       public function getParams() {
        return $this->matchedParams;
       }

    
}

?>