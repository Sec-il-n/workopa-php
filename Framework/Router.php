<?php
// $routes = require basePath('routes.php');
// inspect($routes[$uri]);

// if (array_key_exists($uri, $routes)) {
//     require(basePath($routes[$uri]));
// } else {
//     http_response_code(404);
//     require(basePath($routes['404']));
// }
namespace Framework;
use App\controllers\ErrorController;

class Router {
    protected $routes = [];

    /**
     * Add a new route
     *
     * @param string $method
     * @param string $uri
     * @param string $action
     * @return void
     */
    // public function registerRoute($method, $uri, $contoroller){
    public function registerRoute($method, $uri, $action){
            list($controller, $controllerMethod) = explode('@' , $action);
            // inspectAndDie($controller);

            $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller,
            'controllerMethod' => $controllerMethod
        ];
    }
    
    /**
     * Add a GET route
     * @param string $uri
     * @param string $contoroller 
     * @return void
     */
    public function get($uri, $controller){
        $this->registerRoute('GET', $uri, $controller);
    }

    /**
     * Add a POST route
     * @param string $uri
     * @param string $controller 
     * @return void
     */
    public function post($uri, $controller){
        $this->registerRoute('POST', $uri, $controller);
    }

        /**
     * Add a PUT route
     * @param string $uri
     * @param string $controller 
     * @return void
     */
    public function put($uri, $controller){
        $this->registerRoute('PUT', $uri, $controller);   
    }

        /**
     * Add a DELETE route
     * @param string $uri
     * @param string $controller 
     * @return void
     */
    public function delete($uri, $controller){
        $this->registerRoute('DELETE', $uri, $controller);    
    }

    /**
     * Load error page
     * @param int $httpCode
     * @return void
     */
    // public function error($httpCode = 404){
    //     http_response_code($httpCode);
    //     loadView("error/{$httpCode}");
    //     exit;
    // }

     
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
                // require basePath('App/' . $route['controller']);
                // Extract controller and controllerMethod
                $controller = 'App\\Controllers\\' . $route['controller'];
                $controllerMethod = $route['controllerMethod'];

                // Instantiate the controller and call the method
                $controllerInstance = new $controller();
                $controllerInstance->$controllerMethod();
                // ↑下記と同義
                // $listing =new ListingController();
                // $listing->index();
                return;
            }          
        }
        // $this->error();
        ErrorController::notFound();
    }

   
}