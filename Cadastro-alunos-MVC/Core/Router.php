<?php
class Router
{
    protected $routes = [];
    protected $params = [];

    public function add($method, $route, $controllerAction)
    {
        $route = preg_replace('/\{([a-z0-9_]+)\}/', '(?P<$1>[a-zA-Z0-9_-]+)', $route);
        $route = '#^' . $route . '$#';
        $this->routes[$method][$route] = $controllerAction;
    }

    protected function getUrl()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $script_name = dirname($_SERVER['SCRIPT_NAME']);
        $route = str_replace($script_name, '', $uri);
        return trim($route, '/');
    }
    
    public function dispatch()
    {
        $url = $this->getUrl();
        $method = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes[$method] as $route => $action) {
            if (preg_match($route, $url, $matches)) {
                $this->params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                $this->executeAction($action);
                return;
            }
        }
        $this->notFound();
    }

    protected function executeAction($action)
    {
        list($controllerName, $methodName) = explode('@', $action);
        $controllerFile = __DIR__ . '/../App/Controllers/' . $controllerName . '.php';

        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            if (class_exists($controllerName)) {
                $controller = new $controllerName();
                if (method_exists($controller, $methodName)) {
                    $controller->$methodName($this->params);
                    return;
                }
            }
        }
        $this->notFound();
    }

    protected function notFound()
    {
        http_response_code(404);
        require_once __DIR__ . '/../App/Views/404.php';
        exit;
    }
}