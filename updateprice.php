<?php
$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    header("Content-Type: application/json");
    echo json_encode(["error" => "Invalid data"]);
    exit;
}

$voyage_id = $data['voyage_id'];
$hotel = $data['hotel'];
$activities = $data['activities'];

$voyages = json_decode(file_get_contents('dataJSON/fly.json'), true);

$voyage = null;
foreach ($voyages as $v) {
    if ($v['id'] == $voyage_id) {
        $voyage = $v;
        break;
    }
}

if (!$voyage) {
    header("Content-Type: application/json");
    echo json_encode(["error" => "Trip not found."]);
    exit;
}

$prix_hotel = 0;
foreach ($voyage['hotels'] as $h) {
    if ($h['nom'] == $hotel) {
        $prix_hotel = (float)$h['prix'];
        break;
    }
}
$prix_activites_total = 0;
foreach ($activities as $activity) {
    foreach (['activite1', 'activite2', 'activite3', 'activite4'] as $activite_group) {
        foreach ($voyage[$activite_group] as $act) {
            if ($act['nom'] == $activity) {
                $prix_activites_total += (float)$act['prix'];
                break;
            }
        }
    }
}
$prix_base = (float)$voyage['prix']*2;
$total = $prix_base + $prix_hotel + $prix_activites_total;

error_log("Data received: " . print_r($data, true));

header("Content-Type: application/json");
echo json_encode(["total" => $total]);
?>
