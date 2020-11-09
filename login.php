<?php

include "./db/connection.php";

$userEmail = $_POST['email'];
$query = "select l.latitude, l.longitude, l.created_at, u.email from login l inner join user u on l.user_id = u.id where u.email = '" . $userEmail ."' order by created_at desc limit 1";
$login = $dao->runRawQuery($query,null,true);

if (count($login) > 0) {
    $handle = curl_init();
    $url = "https://apis.datos.gob.ar/georef/api/ubicacion?lat=".$login[0]['latitude']."&lon=".$login[0]['longitude'];
    curl_setopt($handle, CURLOPT_URL, $url);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($handle);
    curl_close($handle);
    $login[0]['provincia'] = json_decode($output)->ubicacion->provincia->nombre;
}

header('Content-Type: application/json');
echo json_encode($login);

