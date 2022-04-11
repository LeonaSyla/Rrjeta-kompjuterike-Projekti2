<?php 

$host = "127.0.0.1";
$port = 25003;
set_time_limit(0);

$sock = socket_create(AF_INET, SOCK_STREAM, 0) or die("Socket eshte krijuar\n");
$result = socket_bind($sock, $host,$port) or die("Eshte krijuar lidhja.\n");

$result = socket_listen($sock,3) or die("Listening...\n");

echo "\n\nDuke pritur per lidhje...\n\n";


class Chat
{
	function readline()
	{
		return rtrim(fgets(STDIN));
	}
}

do
