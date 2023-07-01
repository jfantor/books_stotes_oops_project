<?php

include "../model/database.php";

session_start();

session_unset();

session_destroy();

header("Location: {$hostname}/view/loglin_form.php");

?>