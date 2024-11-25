<?php
session_start();
unset($_SESSIONp['userEmail']);
header("Location: ../htmlFiles/userLogin.html");


?>