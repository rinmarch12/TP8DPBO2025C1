<?php
// Mulai session
session_start();

// Load controllers
require_once 'controllers/StudentController.php';
require_once 'controllers/CourseController.php';
require_once 'controllers/EnrollmentController.php';
require_once 'controllers/HomeController.php';

// Router sederhana untuk MVC
$action = isset($_GET['action']) ? $_GET['action'] : 'home';
$method = isset($_GET['method']) ? $_GET['method'] : 'index';
$id = isset($_GET['id']) ? $_GET['id'] : null;

// Routing ke controller yang sesuai
switch ($action) {
    case 'home':
        $controller = new HomeController();
        break;
        
    case 'students':
        $controller = new StudentController();
        break;
    
    case 'courses':
        $controller = new CourseController();
        break;
        
    case 'enrollments':
        $controller = new EnrollmentController();
        break;
        
    default:
        $controller = new HomeController();
        break;
}

// Routing ke method yang sesuai
switch ($method) {
    case 'index':
        $controller->index();
        break;
        
    case 'create':
        $controller->create();
        break;
        
    case 'edit':
        if ($id !== null) {
            $controller->edit($id);
        } else {
            // Set pesan error jika ID tidak ada
            $_SESSION['error'] = "ID tidak valid";
            header("Location: index.php?action=$action");
            exit();
        }
        break;
        
    case 'delete':
        if ($id !== null) {
            $controller->delete($id);
        } else {
            // Set pesan error jika ID tidak ada
            $_SESSION['error'] = "ID tidak valid";
            header("Location: index.php?action=$action");
            exit();
        }
        break;
    default:
        $controller->index();
        break;
}
?>