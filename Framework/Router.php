<?php
// $routes = require basePath('routes.php');
// inspect($routes[$uri]);

// if (array_key_exists($uri, $routes)) {
//     require(basePath($routes[$uri]));
// } else {
//     http_response_code(404);
//     require(basePath($routes['404']));
// }
class Router {
    protected $routes = [];

    /**
     * Add a new route
     *
     * @param string $method
     * @param string $uri
     * @param string $contoroller
     * @return void
     */
    public function registerRoute($method, $uri, $contoroller){
            $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $contoroller
        ];
    }
    
    /**
     * Add a GET route
     * @param string $uri
     * @param string $contoroller 
     * @return void
     */
    public function get($uri, $contoroller){
        $this->registerRoute('GET', $uri, $contoroller);
    }

    /**
     * Add a POST route
     * @param string $uri
     * @param string $contoroller 
     * @return void
     */
    public function post($uri, $contoroller){
        $this->registerRoute('POST', $uri, $contoroller);
    }

        /**
     * Add a PUT route
     * @param string $uri
     * @param string $contoroller 
     * @return void
     */
    public function put($uri, $contoroller){
        $this->registerRoute('PUT', $uri, $contoroller);   
    }

        /**
     * Add a DELETE route
     * @param string $uri
     * @param string $contoroller 
     * @return void
     */
    public function delete($uri, $contoroller){
        $this->registerRoute('DELETE', $uri, $contoroller);    
    }

    /**
     * Load error page
     * @param int $httpCode
     * @return void
     */
    public function error($httpCode = 404){
        http_response_code($httpCode);
        loadView("error/{$httpCode}");
        exit;
    }

     
    /**
     * Route the request
     * 
     * @param string $uri
     * @param string $method
     * @return void
     */
    public function route($uri, $method){
        foreach($this->routes as $route){
            if($route['uri'] === $uri && $route['method'] === $method){
                require basePath('App/' . $route['controller']);
                return;
            }          
        }
        $this->error();
        // http_response_code(404);
        // loadView('error/404');
        // exit;
    }

   
}