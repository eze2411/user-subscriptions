<?php

include "./db/connection.php";

$searchStr = array_key_first($_POST);
$users = $dao->runRawQuery("select id as user_id, email as user_email from user where email like ('%".$searchStr."%')",null,true);

header('Content-Type: application/json');
echo json_encode($users);
