<?php
$user  = $_GET['User'] ?? '';
$token = $_GET['Token'] ?? '';

if ($user === '' || $token === '') {
    exit("INVALID");
}

$file = "sessions/$user.json";
if (!file_exists($file)) {
    exit("INVALID");
}

$data = json_decode(file_get_contents($file), true);
if ($data['token'] !== $token) {
    exit("INVALID");
}

unlink($file);
echo "OK";
