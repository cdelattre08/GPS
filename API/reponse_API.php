<?php include("../include/database.php"); global $db;
extract($_POST);  
//on extract les information recu en js pour traitement en php apres on le decode est on le mais dans tabreturn
$tabReturn = json_decode($_POST['json'],true);
echo json_encode($tabReturn);

$requete = $db->prepare("INSERT INTO `GPS`(`Date`, `Heure`, `Latitude`, `Longitude`, `Vitesse`, `Vitesse_moyenne`, `BateauID`) VALUES (:datee,:heure,:lat,:lng,:vit,:vitmoy,:batid)");
$requete->execute([
    'datee' => $tabReturn['dte'],
    'heure' => $tabReturn['hre'],
    'lat' => $tabReturn['lat'],
    'lng' => $tabReturn['lng'],
    'vit' => $tabReturn['vit'],
    'vitmoy' => $tabReturn['vitm'],
    'batid' => $tabReturn['bid'],

]);
?>
