<?php

namespace App\Core;

class App {
    protected $controller = 'HomeController';
    protected $method = 'index';
    protected $params = [];

    public function __construct() {
        $url = $this->parseUrl();

        // Controller
        if (!empty($url[0])) {
            $controllerName = ucfirst($url[0]) . 'Controller';
            if (file_exists('../app/Controllers/' . $controllerName . '.php')) {
                $this->controller = $controllerName;
                unset($url[0]);
            }
        }
        
        // Require the controller
        if (file_exists('../app/Controllers/' . $this->controller . '.php')) {
            require_once '../app/Controllers/' . $this->controller . '.php';
            
            $controllerClass = '\\App\\Controllers\\' . $this->controller;
            $this->controller = new $controllerClass();

            // Method
            if (isset($url[1])) {
                if (method_exists($this->controller, $url[1])) {
                    $this->method = $url[1];
                    unset($url[1]);
                }
            }
        } else {
             // 404 Not Found handling could go here
             echo "Controller not found: " . $this->controller;
             return;
        }

        // Params
        $this->params = $url ? array_values($url) : [];

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl() {
        // Fallback for php -S without .htaccess regex rewrite or Apache .htaccess
        // This looks at the path after the script definition
        $path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        // Remove index.php if present in URL
        $path = str_replace('index.php', '', $path);
        $path = trim($path, '/');
        
        if ($path) {
            return explode('/', filter_var($path, FILTER_SANITIZE_URL));
        }
        return [];
    }
}
