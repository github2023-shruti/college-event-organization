<?php
require_once __DIR__ . '/../init.php';
require_method('POST');
require_admin();
$input = json_decode(file_get_contents('php://input'), true) ?: [];
$title = trim($input['title'] ?? '');
$description = trim($input['description'] ?? '');
$event_date = trim($input['event_date'] ?? '');
$location = trim($input['location'] ?? '');
if ($title === '' || $event_date === '') { json_response(false, 'Title and date are required', null, 400); }
$conn = db();
$stmt = $conn->prepare('INSERT INTO events (title, description, event_date, location, created_by, created_at) VALUES (?, ?, ?, ?, ?, NOW())');
$admin_id = $_SESSION['user']['id'];
$stmt->bind_param('ssssi', $title, $description, $event_date, $location, $admin_id);
if (!$stmt->execute()) { json_response(false, 'Failed to add event', null, 500); }
json_response(true, 'Event added', [ 'id' => $conn->insert_id ]);
