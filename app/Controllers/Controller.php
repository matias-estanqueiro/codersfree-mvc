<?php
    // STEP 1H
    namespace App\Controllers;

    class Controller{
        // METHODS
        public function view($route, $data = []) {
            // destructuring => extract()
            extract($data);
            // If the route is a folder
            $route = str_replace('.', '/', $route);

            if(file_exists("../resources/views/{$route}.php")) {
                ob_start();
                include "../resources/views/{$route}.php";
                $content = ob_get_clean();
                return $content;
            } else {
                return "File not found: {$route}.php";
            }
        }
    }
?>