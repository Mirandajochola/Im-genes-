<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Content-Type: application/json; charset=UTF-8");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pizza2024";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

$orderId = intval($_GET['orderId']);

$sql = "SELECT image, cost FROM orders WHERE id = $orderId";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $order = $result->fetch_assoc();
    echo json_encode($order);
} else {
    echo json_encode(["error" => "Order not found"]);
}

$conn->close();
?>
