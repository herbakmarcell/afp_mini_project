<?php
session_start();
session_destroy();
header("Location: http://localhost/afp_mini_project/program/login.php");
