<?php
$user  = $_GET['User'] ?? '';
$token = $_GET['Token'] ?? '';

if ($user === '' || $token === '') {
    exit("INVALID");
}

$admins = ["HarkinianHexBlud", "SonicElijahMania", "DeveloperHamed", "MohamedHamed247", "thurGT12s", "0nlin3Hub"];
if (!in_array($user, $admins, true)) {
    exit("DENIED");
}

if (!is_dir("sessions")) {
    mkdir("sessions", 0700, true);
}

$data = [
    "user"  => $user,
    "token" => $token,
    "time"  => time()
];

file_put_contents("sessions/$user.json", json_encode($data));
echo "OK";

