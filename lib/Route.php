<?php
    // STEP 1A : Routes - Define

    // Static METHOD : call without instantiation
    // Static PROPERTY : call without instantiation. Use self::, not $this
    namespace Lib;

    class Route {
        // PROPERTIES -----------------
        private static $routes = [];

        // METHODS --------------------
        // Add GET routes to routes array
        public static function get($uri, $callback) {
            // STEP 1E
            $uri = trim($uri, '/');
            // ------------------------------------
            self::$routes['GET'][$uri] = $callback;
        }

        // Add POST routes to routes array
        public static function post($uri, $callback) {
            // STEP 1E
            $uri = trim($uri, '/');
            // ------------------------------------
            self::$routes['POST'][$uri] = $callback;
        }

        // STEP 1E : dispatch
        public static function dispatch() {
            // modify hosts with local domain WIN (.test) -> C:/Windows/System32/drivers/etc/hosts
            // modify config APACHE -> C:/xampp/apache/conf/extra/httpd-vhosts.conf

            $uri = $_SERVER['REQUEST_URI'];
            $uri = trim($uri, '/');
            $method = $_SERVER['REQUEST_METHOD'];
            // echo $uri;
            // echo $method;
            foreach(self::$routes[$method] as $route => $callback) {
                // STEP 1F 
                if(strpos($route, ':')  != false) {
                    // subpattern
                    $route  = preg_replace('#:[a-zA-Z]+#', '([a-zA-Z]+)', $route);
                }
                // ^ : starts with - $ : ends with - matches retrieve subpattern
                if(preg_match("#^$route$#", $uri, $matches)) {
                    // params have all parameters in one array, except the complete uri (position 0)
                    $params = array_slice($matches, 1);
                    // STEP 1G
                    $response = $callback(...$params);
                    if(is_array($response) || is_object($response)) {
                        header('Content-Type: application/json');
                        echo json_encode($response);
                    } else {
                        echo $response;
                    }
                    return;
                }
                
                // if($route == $uri) {
                //     call_user_func($callback);
                //     return;
                // }
            }
            echo "404 - Not found";
        }
    }
?>