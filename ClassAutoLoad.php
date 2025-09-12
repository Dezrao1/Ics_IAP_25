<?php
// ClassAutoLoad.php
require_once 'conf.php';

$directories = ["", "Forms/", "Layout/", "Global/", "Services/", "Models/"];

spl_autoload_register(function($className) use ($directories) {
    // Convert className to the expected file naming convention
    $className = str_replace('_', '/', $className); // For PEAR-style naming
    $fileName = $className . '.php';
    
    foreach ($directories as $directory) {
        $filePath = __DIR__ . "/" . $directory . $fileName;
        if (file_exists($filePath)) {
            require_once $filePath;
            return;
        }
    }
    
    // Log error instead of throwing exception if in production
    error_log("Class '$className' not found in any directory");
});

// Test the autoloader with proper class names
try {
    // These should match your actual class files
    if (class_exists('Forms')) {
        $Form = new Forms();
    }
    
    if (class_exists('Layout')) {
        $Layout = new Layout();
    }
    
    // Remove or replace the non-existent 'classes' reference
    // $hello = new classes(); // This line causes the error
    
} catch (Exception $e) {
    error_log("Autoload error: " . $e->getMessage());
}
?>