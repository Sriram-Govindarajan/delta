<?php
session_start();
session_destroy();
session_unset();

sleep(2);
header('Location: http://localhost/test/my_base.html#!');
?>

<html>
<body>
Logged out successfully
</body>
</html>