<?php

class Router
{
    protected $routes;

    public function __construct($definitions)
    {
        $this->routes = $this->compileRoutes($definitions);
    }

    public function compileRoutes()
    {
        $routes = array();

        foreach ($definitions as $url => $params) {
            $tokens = explode('/', ltrim($url, '/'));
            foreach ($tokens as $i => $token) {
                if (0 === strpos($token, ':')) {
                    $name = substr($token, 1);
                    $token = '(?P<' . $name . '>[^/]+';
                }
                $tokens[$i] = $token;
            }
            $pattern = '/' . implode('/', $tokens);
            $routes[$pattern] = $params;
        }
        return $routes;
    }
}
