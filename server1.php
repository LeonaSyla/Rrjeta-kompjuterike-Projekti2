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
{
	$accept = socket_accept($sock) or die("Nuk u pranua lidhja.");
	$msg = socket_read($accept, 1024) or die("Nuk u lexua mesazhi.\n");
	$msg = trim($msg);

	echo "Klienti:\t".$msg."\n\n";

	$line = new Chat();

	echo "Pergjigjja si server:\t";
	$reply = $line->readline();

	socket_write($accept, $reply, strlen($reply)) or die("Nuk mund te shkruash.");
}while (true);
	socket_close($accept,$sock);
?>