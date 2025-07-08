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
    // public function route($uri, $method){
    public function route($uri){
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        foreach($this->routes as $route){
            //Split the current URI into segments
            $uriSegments = explode('/', trim($uri , '/'));

            // Split the rote uri into segments
            $routeSegments = explode('/' , trim($route['uri'], '/'));

            $match = false;
            // Check if the number of segments match;
            if (count($uriSegments) === count($routeSegments) 
              && strtoupper($route['method']) === $requestMethod) {
                inspect($routeSegments);
                inspect($uriSegments);
                $params = [] ;
                // $match = true; 

                for ($i = 0; $i < count($uriSegments); $i++) {
                    inspect($routeSegments[$i]);
                    inspect($uriSegments[$i]);
                    inspect(preg_match('/\{(.+?)\}/', $routeSegments[$i]));
                    inspect($match);

                    // 追加↓　レクチャーだとパラメタなしの一致がnot foundになる
                    if (count($uriSegments) === count($routeSegments)  && count($uriSegments) === 1 && $routeSegments[$i] === $uriSegments[$i]) {
                        $match = true;
                        inspect($match);
                        break;
                    } 

                    if ($routeSegments[$i] === $uriSegments[$i] && count($uriSegments) > $i + 1) {
                        inspect(count($uriSegments));
                        continue;
                    }

                    if ($routeSegments[$i] === $uriSegments[$i] && count($uriSegments) === $i + 1) {
                        $match = true;
                        inspect(count($uriSegments));
                        inspect($match);
                        break;
                    }

                    // if the uri's do not match and there is no param
                    if ($routeSegments[$i] !== $uriSegments[$i] 
                    && !preg_match('/\{(.+?)\}/' , $routeSegments[$i])) {
                        $match = false;
                        inspect($routeSegments[$i]);
                        inspect($match);                        
                        continue;//レクチャーだと「break」になっていたが、それだとSegmentsの2つ目以降の要素がループされない                        
                    }                

                    // Check for the param and add to $params array
                    if (preg_match('/\{(.+?)\}/', $routeSegments[$i], $matches)) {
                        $match = true;
                        inspect($matches);
                        $params[$matches[1]] = $uriSegments[$i];
                        inspect($match);
                        inspect($params);
                        break;
                    }
                }

                if ($match) {
                    // Extract controller and controllerMethod
                    $controller = 'App\\Controllers\\' . $route['controller'];
                    $controllerMethod = $route['controllerMethod'];

                    // Instantiate the controller and call the method
                    $controllerInstance = new $controller();
                    // $controllerInstance->$controllerMethod();
                    $controllerInstance->$controllerMethod($params);
                    return;
                }
                
            }         
        }
        // $this->error();
        ErrorController::notFound();
    }

   
}