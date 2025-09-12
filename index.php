<?php
//Include the HelloWorld Method
require_once 'CLassAutoLoad.php';

//Display the  header
$layout->header($conf);
//Call the greet method
print $hello->greet();
//Call the todat method
print $hello->today();
//Display the signup forms
$form->signup();

$layout->footer($conf);

