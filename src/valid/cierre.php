<!DOCTYPE html> <html>

<body>

<?php

session_start();
session_destroy();

header("location:/proyecto/index.html");

?>

</body>

</html>