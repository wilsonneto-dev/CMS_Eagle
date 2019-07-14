<?php
header("Cache-Control: no-cache");
header("Content-Type: text/event-stream\n\n");

echo "data: " . json_encode(["success" => "yes", "msg" => "ok"]) . "\n\n";
ob_end_flush();
flush();

sleep(15);


echo "data: " . json_encode(["success" => "yes", "msg" => "ok"]) . "\n\n";
ob_end_flush();
flush();
