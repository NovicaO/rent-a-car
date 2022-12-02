<?php
require_once 'dbInfo.php';
include "includeRights.php";
include "adminAccess.php";
session_start();
$date= date("Y-m-d");

try{

    $conn = new PDO("mysql:host=" . HOST_NAME . ";dbname=" . DATABASE_NAME, USER_NAME, USER_PASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->exec("SET NAMES 'utf8'");
    $sql = "SELECT * FROM vozilo, rent WHERE vozilo.idVozila=rent.idVozilo AND pocetniDatum=:datum  AND servis=1 AND vracen=0";
    $stm = $conn->prepare($sql);
    $stm->bindValue(':datum', $date, PDO::PARAM_STR);
    $results = $stm->execute();
    $data = $stm->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($data);



}catch (PDOException $e)
{
    die($e->getTrace());
}
?>