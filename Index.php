<?php
// Include the ClassAutoLoad Method
require_once 'ClassAutoLoad.php';
$layout->header($conf);
print $hello->today();
$form->signup();
$layout->footer($conf);
