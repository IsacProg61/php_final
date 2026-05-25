<?php
session_start();
session_unset();
session_destroy();

setcookie("usuario", "", time() - 3600, "/");
setcookie("token", "", time() - 3600, "/");

header("Location: index.php?logout=true");
exit();
?>
