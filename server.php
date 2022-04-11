<?php

$ip=gethostbyname("localhost");
$port=9999;


if(!($socket = socket_create(AF_INET, SOCK_STREAM, 0)))
{
	$errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
    
    die("Couldn't create socket: [$errorcode] $errormsg \n");
}

echo "\n\nSocket eshte krijuar.\n\n";


if (!socket_set_option($socket, SOL_SOCKET, SO_REUSEADDR, 1)) {
    echo socket_strerror(socket_last_error($socket));
    exit;
}

// Bind the source address
if( !socket_bind($socket, "127.0.0.1" , 9999) )
{
	$errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
    
    die("Could not bind socket : [$errorcode] $errormsg \n");
}

echo "Lidhja me Socket eshte arritur \n\n";


//listen
socket_listen ($socket , 3);
if(!socket_listen ($socket , 3))
{
	$errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
    
    die("Could not listen on socket : [$errorcode] $errormsg \n");
}

echo "Listening... \n\n";


echo "Duke pritur per lidhjet... \n\n";



?>
