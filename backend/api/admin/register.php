<?php
require_once __DIR__ . '/../init.php';
require_method('POST');
$input = json_decode(file_get_contents('php://input'), true) ?: [];
$name = trim($input['name'] ?? '');
$email = trim($input['email'] ?? '');
$password = $input['password'] ?? '';
if ($name === '' || $email === '' || $password === '') {
  json_response(false, 'All fields are required', null, 400);
}
$conn = db();
$stmt = $conn->prepare('SELECT id FROM admins WHERE email = ? LIMIT 1');
$stmt->bind_param('s', $email);
$stmt->execute();
if ($stmt->get_result()->num_rows > 0) {
  json_response(false, 'Email already registered', null, 409);
}
$stmt = $conn->prepare('INSERT INTO admins (name, email, password_hash, created_at) VALUES (?, ?, ?, NOW())');
$hash = password_hash($password, PASSWORD_DEFAULT);
$stmt->bind_param('sss', $name, $email, $hash);
if (!$stmt->execute()) {
  json_response(false, 'Registration failed', null, 500);
}
json_response(true, 'Admin registered successfully');
