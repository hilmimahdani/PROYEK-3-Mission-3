<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::login');

$routes->get('/home', 'Home::index');


$routes->get('login', 'Auth::login');
$routes->post('login/do', 'Auth::doLogin');
$routes->get('logout', 'Auth::logout');

$routes->get('register', 'Auth::register');
$routes->post('register/do', 'Auth::doRegister');

$routes->get('courses', 'CourseController::index');
$routes->get('courses/detail/(:num)', 'CourseController::detail/$1');
$routes->post('courses/enroll/(:num)', 'CourseController::enroll/$1');

$routes->get('students', 'StudentController::index');

$routes->get('mycourses', 'CourseController::myCourses');

// CRUD Courses (Admin Only)
$routes->get('courses/create', 'CourseController::create');
$routes->post('courses/store', 'CourseController::store');
$routes->get('courses/edit/(:num)', 'CourseController::edit/$1');
$routes->post('courses/update/(:num)', 'CourseController::update/$1');
$routes->get('courses/delete/(:num)', 'CourseController::delete/$1');
