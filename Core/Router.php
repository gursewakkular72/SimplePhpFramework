<?php 

namespace Core; 
// use App\controller\Home; 
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
  

       public function dispatch($url) {

        $url = $this->removeQueryStringVariables($url);

         if($this->match($url)) {

          $params = $this->getParams(); 
          $controller = $params['controller']; 
          $controller = $this->converToStudlyCaps($controller); 
          $controller = "App\Controllers\\$controller"; 
          echo $controller. '-> controller <br>'; 

          if(class_exists($controller)) {
            $controllerObj = new $controller($this->matchedParams); 
            $action = $params['action']; 
            $action = $this->converToCamelCase($action); 

            // checking if the action has 'Action' suffix
            if (preg_match('/action$/i', $action) == 0) {
              $controllerObj->$action();
          } else {
              throw new \Exception("Method $action in controller $controller cannot be called directly - remove the Action suffix to call this method");
          }
        

          }
          else {
            echo $controller.' class does not exist.'; 
          }



         }
         else {
          echo ' No route has matched'; 
         }
       }


       public function converToStudlyCaps($controller) {

        return str_replace("-", '', ucwords($controller, '-'));
       }

       public function converToCamelCase($action) {
        return lcfirst($this->converToStudlyCaps($action)); 
       }
       


       /**
     * Remove the query string variables from the URL (if any). As the full
     * query string is used for the route, any variables at the end will need
     * to be removed before the route is matched to the routing table. For
     * example:
     *
     *   URL                           $_SERVER['QUERY_STRING']  Route
     *   -------------------------------------------------------------------
     *   localhost                     ''                        ''
     *   localhost/?                   ''                        ''
     *   localhost/?page=1             page=1                    ''
     *   localhost/posts?page=1        posts&page=1              posts
     *   localhost/posts/index         posts/index               posts/index
     *   localhost/posts/index?page=1  posts/index&page=1        posts/index
     *
     * A URL of the format localhost/?page (one variable name, no value) won't
     * work however. (NB. The .htaccess file converts the first ? to a & when
     * it's passed through to the $_SERVER variable).
     *
     * @param string $url The full URL
     *
     * @return string The URL with the query string variables removed
     */
    protected function removeQueryStringVariables($url)
    {
     
        if ($url != '') {
            $parts = explode('&', $url);
            if (strpos($parts[0], '=') === false) {
                $url = $parts[0];
            } else {
                $url = '';
            }
        }

        echo $url. ' -- $urk'; 

        return $url;
    }



    
}

?>