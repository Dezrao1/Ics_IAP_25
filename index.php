<?php
//Include the HelloWorld Method
require_once 'ClassAutoLoad.php';

//Display the header
$layout->header($conf);
//Call the greet method
print $hello->greet();
//Call the today method
print $hello->today();

// Add a link to View Registered Users
print'<p><a href="users.php">View Registered Users</a></p>';

//Display the signup forms
$form->signup();

$layout->footer($conf);

