<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('home', 'Home::index');
$routes->get('about', 'Home::about');
$routes->get('contact', 'Home::contact');


$routes->get('/register', 'Auth::register');
$routes->post('/register', 'Auth::register');
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::login');
$routes->get('/logout', 'Auth::logout');
$routes->get('/dashboard', 'Auth::dashboard');


$routes->get('admin/dashboard', 'AdminController::index');
$routes->get('teacher/dashboard', 'TeacherController::dashboard');
$routes->get('student/dashboard', 'StudentController::dashboard');

$routes->get('user/dashboard', 'UserController::index');

// Course Enrollment Route - Moved inside student group for consistency
// $routes->post('/course/enroll', 'StudentController::enroll');

// Admin routes
$routes->group('admin', function($routes) {
    $routes->get('users', 'AdminController::users');
    $routes->get('courses', 'AdminController::courses');
    $routes->get('courses/create', 'AdminController::createCourse');
    $routes->post('courses/store', 'AdminController::storeCourse');
    $routes->get('analytics', 'AdminController::analytics');
    $routes->get('reports', 'AdminController::reports');
    $routes->get('settings', 'AdminController::settings');
    $routes->get('profile', 'AdminController::profile');
});

// Teacher routes
$routes->group('teacher', function($routes) {
    $routes->get('courses', 'TeacherController::courses');
    $routes->get('course/(:num)', 'TeacherController::courseDetails/$1');
    $routes->post('course/(:num)/unenroll', 'TeacherController::unenrollStudent/$1');
    $routes->get('create-course', 'TeacherController::createCourse');
    $routes->post('store-course', 'TeacherController::storeCourse');
    $routes->get('students', 'TeacherController::students');
    $routes->get('assignments', 'TeacherController::assignments');
    $routes->get('gradebook', 'TeacherController::gradebook');
    $routes->get('announcements', 'TeacherController::announcements');
    $routes->get('analytics', 'TeacherController::analytics');
    $routes->get('profile', 'TeacherController::profile');
});

// Student routes
$routes->group('student', function($routes) {
    $routes->get('courses', 'StudentController::courses', ['filter' => 'auth']);
    $routes->post('enroll', 'StudentController::enroll', ['filter' => 'auth']);
    $routes->get('assignments', 'StudentController::assignments', ['filter' => 'auth']);
    $routes->get('grades', 'StudentController::grades', ['filter' => 'auth']);
    $routes->get('progress', 'StudentController::progress', ['filter' => 'auth']);
    $routes->get('calendar', 'StudentController::calendar', ['filter' => 'auth']);
    $routes->get('announcements', 'StudentController::announcements', ['filter' => 'auth']);
    $routes->get('profile', 'StudentController::profile', ['filter' => 'auth']);
});

// User routes
$routes->group('user', function($routes) {
    $routes->get('profile', 'UserController::profile');
    $routes->get('settings', 'UserController::settings');
    $routes->get('notifications', 'UserController::notifications');
    $routes->get('help', 'UserController::help');
});

$routes->setAutoRoute(true);