<?php

define('DOCROOT', __DIR__);
require(DOCROOT.'/system/config/bootstrap.php');

request::loadRequest();
$controller_name = router::getControllerName();

// if language was changed, process the form submit
i18n::processLanguageChange();

// start output buffering
ob_start();

router::runController($controller_name);

// end output buffering and return the contents of the buffer
echo ob_get_clean();

?>

