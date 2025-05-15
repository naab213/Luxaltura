<?php
header('Content-Type: application/json');

$voyages = json_decode(file_get_contents('dataJSON/fly.json'), true);

$data = json_decode(file_get_contents('php://input'), true);
$voyage_id = $data['voyage_id'] ?? null;
$selected_hotel = $data['hotel'] ?? null;
$selected_activities = $data['activities'] ?? [];

if (!$voyage_id) {
    echo json_encode(['error' => 'Invalid voyage ID']);
    exit;
}

$selected_voyage = null;
foreach ($voyages as $voyage) {
    if ($voyage['id'] == $voyage_id) {
        $selected_voyage = $voyage;
        break;
    }
}

if (!$selected_voyage) {
    echo json_encode(['error' => 'Voyage not found']);
    exit;
}

$base_price = $selected_voyage['prix'] * 2;

$hotel_price = 0;
foreach ($selected_voyage['hotels'] as $hotel) {
    if ($hotel['nom'] === $selected_hotel) {
        $hotel_price = $hotel['prix'];
        break;
    }
}

$activities_price = 0;
$activity_details = [];
foreach ($selected_voyage as $key => $group) {
    if (strpos($key, 'activite') === 0 && is_array($group)) {
        foreach ($group as $activity) {
            if (in_array($activity['nom'], $selected_activities)) {
                $activities_price += $activity['prix'];
                $activity_details[] = $activity;
            }
        }
    }
}

$total = $base_price + $hotel_price + $activities_price;

echo json_encode([
    'success' => true,
    'base_price' => $base_price,
    'hotel_price' => $hotel_price,
    'activities_price' => $activities_price,
    'total' => $total,
    'activity_details' => $activity_details
]);
?>
