<?php
/* Make sure to start session to unset all session superglobal variables */
session_start();
/* The superglobal session variables are cleared */
$_SESSION = [];
/* Loging out the user so now you want to end the session */
session_destroy();
/* The default will be for both admins and users to be routed to the home page */
header('location: ./index.php');
exit;
