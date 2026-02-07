<?php
$user  = $_GET['User'] ?? '';
$token = $_GET['Token'] ?? '';

if ($user === '' || $token === '') {
    exit("INVALID");
}

$admins = ["Team0verSky", "Leproadu", "Letresor200", "Letresor666", "W00lnX", "Letresor0", "0nlin3Hub", "DeveloperHamed", "HarkinianHexBlud", "MohamedHamed247"];
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
