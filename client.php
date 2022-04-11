<?php
set_time_limit(0);

$host = "127.0.0.1";
$port =9999 ;

$socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("socket_create fail\n");
$result = socket_connect($socket, $host, $port) or die("socket_connect fail\n");


echo "Lidhja me server eshte arritur. \n\n";

while (true)
{ echo "\nSheno: ";
    $in = fgets(STDIN);
    $out = '';

    if(!socket_write($socket, $in, strlen($in))) {
        echo "socket_write() failed. reason: " . socket_strerror($socket) . "\n";
    }

    $out = socket_read($socket, 9999);
    echo "Serveri: $out\n";
}
socket_close($socket);
?> 
 
