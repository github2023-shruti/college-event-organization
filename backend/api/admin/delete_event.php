<?php
require_once __DIR__ . '/../init.php';
require_method('POST');
require_admin();
$input = json_decode(file_get_contents('php://input'), true) ?: [];
$id = (int)($input['id'] ?? 0);
if ($id <= 0) { json_response(false, 'Invalid id', null, 400); }
$conn = db();
$stmt = $conn->prepare('DELETE FROM events WHERE id = ?');
$stmt->bind_param('i', $id);
if (!$stmt->execute()) { json_response(false, 'Failed to delete event', null, 500); }
json_response(true, 'Event deleted');
