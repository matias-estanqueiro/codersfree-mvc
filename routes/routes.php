<?php
    // STEP 1D : Routes - One access point
    use Lib\Route;
    use App\Controllers\HomeController;

    // STEP 1G
    Route::get('/', [HomeController::class, 'index']);

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