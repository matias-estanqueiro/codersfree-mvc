<?php
    // STEP 1D : Routes
    use Lib\Route;

    Route::get('/', function() {
        // STEP 1G : return
        return [
            'title' => 'Home',
            'content' => 'Home content'
        ];
    });

    Route::get('/contact', function() {
        return 'Contact URI';
    });

    Route::get('/about', function() {
        return 'About URI';
    });

    // STEP 1F : Routes - variables
    Route::get('/courses/:id', function($id) {
        return 'Name of the course: ' . $id;
    });    

    Route::dispatch();
?>