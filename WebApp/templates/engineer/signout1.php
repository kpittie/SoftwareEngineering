<?php
/**
 * Created by NOTEPAD++
 * User: INDRANIL OJHA
 * Date: 14-04-2016
 * Time: 1:10 PM
 */
session_start();
session_destroy();
header("Location: ../../templates/index.php");
?>