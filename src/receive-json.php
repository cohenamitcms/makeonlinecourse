<?php
// receive-json.php

header("Content-Type: application/json");

// Get the raw POST data
$data = json_decode(file_get_contents('php://input'), true);

// Check if data was received
if ($data) {
    // Log the received data (you can modify this to save to a database, etc.)
    file_put_contents('received_data.json', json_encode($data, JSON_PRETTY_PRINT));

    // Prepare a response
    $response = [
        'status' => 'success',
        'message' => 'Data received successfully',
        'receivedData' => $data
    ];

    // Send the response back to Make.com or to the client
    echo json_encode($response);
} else {
    // If no data was received, return an error response
    $response = [
        'status' => 'error',
        'message' => 'No data received'
    ];

    echo json_encode($response);
}
?>
