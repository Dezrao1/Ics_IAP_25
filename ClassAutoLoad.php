<?php
// ClassAutoLoad.php
require_once 'conf.php';

// Add "Services/" to the directories array
$directories = ["", "Forms/", "Layout/", "Global/", "Services/", "Models/"];

spl_autoload_register(function($className) use ($directories) {
    $className = str_replace('_', '/', $className);
    $fileName = $className . '.php';
    
    foreach ($directories as $directory) {
        $filePath = __DIR__ . "/" . $directory . $fileName;
        if (file_exists($filePath)) {
            require_once $filePath;
            return;
        }
    }
    
    error_log("Class '$className' not found in any directory");
});

// Create instances only if classes exist
try {
    if (class_exists('Forms')) {
        $form = new Forms();
    }
    
    if (class_exists('Layout')) {
        $layout = new Layout();
    }
    
} catch (Exception $e) {
    error_log("Autoload error: " . $e->getMessage());
}
?>