<?php

try{
    $db = new PDO ('mysql:host=localhost;dbname=awafi;charset=utf8','root','');
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_ERRMODE,false);
    // echo "connected successfuly";
}
catch(PDOException $e){
    echo $e->getMessage();
}
?>
