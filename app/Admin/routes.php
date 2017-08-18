<?php

use Illuminate\Routing\Router;

Admin::registerHelpersRoutes();

Route::group([
    'prefix'        => config('admin.prefix'),
    'namespace'     => Admin::controllerNamespace(),
    'middleware'    => ['web', 'admin'],
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('teacher', TeacherController::class);
    $router->resource('city', CityController::class);
    $router->resource('course', CourseController::class);
    $router->resource('specialty', SpecialtyController::class);
    $router->resource('student', StudentController::class);
    $router->resource('classroom',ClassRoomController::class);
});
