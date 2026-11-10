<?php
require_once __DIR__ . '/../init.php';
require_method('POST');
require_admin();
$input = json_decode(file_get_contents('php://input'), true) ?: [];
$id = (int)($input['id'] ?? 0);
$title = trim($input['title'] ?? '');
$description = trim($input['description'] ?? '');
$event_date = trim($input['event_date'] ?? '');
$location = trim($input['location'] ?? '');
if ($id <= 0 || $title === '' || $event_date === '') { json_response(false, 'Invalid payload', null, 400); }
$conn = db();
$stmt = $conn->prepare('UPDATE events SET title = ?, description = ?, event_date = ?, location = ? WHERE id = ?');
$stmt->bind_param('ssssi', $title, $description, $event_date, $location, $id);
if (!$stmt->execute()) { json_response(false, 'Failed to update event', null, 500); }
json_response(true, 'Event updated');
