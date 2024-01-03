<?php
    // STEP 1G : Controllers
    namespace App\Controllers;
    class HomeController {
        // METHODS
        public function index() {
            return [
                'title' => 'Home',
                'content' => 'Home content'
            ];
        }
    }