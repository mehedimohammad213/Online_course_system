<?php
session_start();

// Autoloader
spl_autoload_register(function ($class) {
    // Prefix for our namespace
    $prefix = 'App\\';
    
    // Base directory for the namespace prefix
    $base_dir = __DIR__ . '/../app/';
    
    // Does the class use the namespace prefix?
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // no, move to the next registered autoloader
        return;
    }
    
    // Get the relative class name
    $relative_class = substr($class, $len);
    
    // Replace the namespace prefix with the base directory, replace namespace
    // separators with directory separators in the relative class name, append
    // with .php
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    
    // If the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});

// Require Core Files (Just in case autoloader misses or for bootstrapping order)
// Using autoloader is better but let's ensure Core is available
// require_once '../app/Core/App.php';
// require_once '../app/Core/Controller.php';
// require_once '../app/Core/Database.php';
// require_once '../app/Core/Model.php';

$app = new \App\Core\App();
