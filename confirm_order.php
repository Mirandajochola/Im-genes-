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

$data = json_decode(file_get_contents("php://input"));

if (isset($data->image) && isset($data->cost)) {
    $image = $conn->real_escape_string($data->image);
    $cost = (int)$data->cost;

    $sql = "INSERT INTO orders (image, cost) VALUES ('$image', $cost)";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["orderId" => $conn->insert_id]);
    } else {
        echo json_encode(["error" => "Error: " . $sql . "<br>" . $conn->error]);
    }
} else {
    echo json_encode(["error" => "Invalid data"]);
}

$conn->close();
?>
