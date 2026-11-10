<?php
session_start();
header('Content-Type: application/json');
header('Cache-Control: no-store');

function json_response($success, $message = '', $data = null, $code = 200) {
  http_response_code($code);
  echo json_encode(['success' => $success, 'message' => $message, 'data' => $data]);
  exit;
}

function db() {
  static $conn = null;
  if ($conn) return $conn;
  $host = 'localhost';
  $user = 'root';
  $pass = 'Pass123';
  $name = 'college_events';
  $conn = new mysqli($host, $user, $pass, $name);
  if ($conn->connect_error) {
    json_response(false, 'Database connection failed', null, 500);
  }
  $conn->set_charset('utf8mb4');
  return $conn;
}

function require_method($method) {
  if ($_SERVER['REQUEST_METHOD'] !== $method) {
    json_response(false, 'Method not allowed', null, 405);
  }
}

function require_admin() {
  if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    json_response(false, 'Unauthorized', null, 401);
  }
}

function require_student() {
  if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'student') {
    json_response(false, 'Unauthorized', null, 401);
  }
}
