<?php
require_once __DIR__ . '/../init.php';
require_method('POST');
$input = json_decode(file_get_contents('php://input'), true) ?: [];
$email = trim($input['email'] ?? '');
$password = $input['password'] ?? '';
if ($email === '' || $password === '') {
  json_response(false, 'Email and password are required', null, 400);
}
$conn = db();
$stmt = $conn->prepare('SELECT id, name, email, password_hash FROM students WHERE email = ? LIMIT 1');
$stmt->bind_param('s', $email);
$stmt->execute();
$res = $stmt->get_result();
if ($res->num_rows === 0) { json_response(false, 'Invalid credentials', null, 401); }
$row = $res->fetch_assoc();
if (!password_verify($password, $row['password_hash'])) { json_response(false, 'Invalid credentials', null, 401); }
$_SESSION['user'] = [ 'id' => (int)$row['id'], 'role' => 'student', 'name' => $row['name'], 'email' => $row['email'] ];
json_response(true, 'Login successful', ['role' => 'student']);
