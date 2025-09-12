<?php
//Include the HelloWorld Method
require_once 'ClassAutoLoad.php';

//Display the header
$Layout->header($conf);
// Call methods with try-catch for better error handling
try {
    // Call the greet method
    if (isset($hello) && method_exists($hello, 'greet')) {
        print $hello->greet();
    } else {
        throw new Exception("Greet method not available");
    }
} catch (Exception $e) {
    error_log("Error calling greet(): " . $e->getMessage());
    print "Shallom, We would like to invite you to the ICS C Community as on ";
}

try {
    // Call the today method
    if (isset($hello) && method_exists($hello, 'today')) {
        print $hello->today();
    } else {
        throw new Exception("Today method not available");
    }
} catch (Exception $e) {
    error_log("Error calling today(): " . $e->getMessage());
    print date('l, F j, Y'); // Formatted default date
}
// Add a link to View Registered Users
print'<p><a href="users.php">View Registered Users</a></p>';

//Display the signup forms
$Form->Signup();

$Layout->footer($conf);

