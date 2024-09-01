<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Content-Type: application/json");

// Get the raw POST data
$rawData = file_get_contents('php://input');

// Check if raw data was received
if ($rawData === false) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Failed to read POST data'
    ]);
    exit;
}

// Decode the JSON data
$data = json_decode($rawData, true);

// Check if data was successfully decoded
if (json_last_error() !== JSON_ERROR_NONE) {
    echo json_encode([
        'status' => 'error',
        'message' => 'JSON decoding error: ' . json_last_error_msg(),
        'rawData' => $rawData
    ]);
    exit;
}

// Log the received data (for debugging purposes)
file_put_contents('received_data.log', $rawData . "\n", FILE_APPEND);

if ($data) {
    // Process the data (e.g., save to a file)
    file_put_contents('processed_data.json', json_encode($data, JSON_PRETTY_PRINT));

    // Send success response
    echo json_encode([
        'status' => 'success',
        'message' => 'Data received successfully',
        'receivedData' => $data
    ]);
} else {
    // Send error response if no data was received
    echo json_encode([
        'status' => 'error',
        'message' => 'No valid JSON data received',
        'rawData' => $rawData
    ]);
}
