<?php
require_once __DIR__ . '/../init.php';
require_method('GET');
$conn = db();
$result = $conn->query('SELECT id, title, description, DATE(event_date) as event_date, location FROM events ORDER BY event_date ASC, id DESC');
$rows = [];
while ($row = $result->fetch_assoc()) { $rows[] = $row; }
json_response(true, 'OK', $rows);
