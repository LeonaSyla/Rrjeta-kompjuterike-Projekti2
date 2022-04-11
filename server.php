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


$clients = array($socket);

while (true){
    $read = $clients;
    $write = null;
    $except = null;

    if (socket_select($read, $write, $except, 0) < 1){
        continue;
    }

    if (in_array($socket, $read))
    {
        $clients[] = $newsock = socket_accept($socket);
        socket_write($newsock, "Gjithsej jane lidhur ".(count($clients) - 1)." client(a) me serverin\n\n");
        socket_getpeername($newsock, $ip, $port);
        echo "Klienti i ri eshte lidhur: {$ip}\n\n";
        $key = array_search($socket, $read);
        unset($read[$key]);
    }


foreach ($read as $read_sock){
        // read until newline or 1024 bytes
        // socket_read while show errors when the client is disconnected, so silence the error messages
        $data = @socket_read($read_sock, 4096, PHP_BINARY_READ);
        // check if the client is disconnected
        if ($data === false)
        {
            // remove client for $clients array
            $key = array_search($read_sock, $clients);
            unset($clients[$key]);
            echo "Nje kliente ka dalur nga lidhja. Tani jane gjithsej ". count(array_filter($clients))-1 . " kliente.";
            continue;
        }
     // clean up input string
        $data = trim($data);
        if (!empty($data))
        {
            echo "\nKlienti ".(count($clients) - 1). ": {$data}\n\n";
            // send some message to listening socket
            //socket_write($read_sock, $send_data);
           // send this to all the clients in the $clients array (except the first one, which is a listening socket)
            foreach ($clients as $send_sock){
            if ($send_sock == $socket)
            continue;
            socket_write($send_sock, $data);
            } // end of broadcast foreach
        }


    } // end of reading foreach

}


socket_close($socket);


?>
