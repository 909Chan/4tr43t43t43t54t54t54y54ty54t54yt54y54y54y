<?php
$user  = $_GET['User']  ?? '';
$token = $_GET['Token'] ?? '';
$code  = $_GET['Code']  ?? '';

$admins = ["HarkinianHexBlud", "SonicElijahMania", "DeveloperHamed", "MohamedHamed247", "thurGT12s", "0nlin3Hub"];

if (!is_dir("queue")) {
    mkdir("queue", 0700, true);
}

$queueFile = "queue/commands.json";
if (!file_exists($queueFile)) {
    file_put_contents($queueFile, json_encode([]));
}

if ($user !== '' && $token !== '' && $code !== '') {

    if (!in_array($user, $admins, true)) {
        exit("DENIED");
    }

    $sessionFile = "sessions/$user.json";
    if (!file_exists($sessionFile)) {
        exit("NOSESSION");
    }

    $session = json_decode(file_get_contents($sessionFile), true);
    if ($session['token'] !== $token) {
        exit("BADTOKEN");
    }

    $queue = json_decode(file_get_contents($queueFile), true);
    $queue[] = [
        "user" => $user,
        "code" => $code,
        "time" => time()
    ];

    file_put_contents($queueFile, json_encode($queue));
    exit("QUEUED");
}

$queue = json_decode(file_get_contents($queueFile), true);

file_put_contents($queueFile, json_encode([]));

header("Content-Type: application/json");
echo json_encode($queue);

