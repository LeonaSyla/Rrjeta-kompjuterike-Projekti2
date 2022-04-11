<?php
set_time_limit(0);

$host = "127.0.0.1";
$port =9999 ;

$socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("socket_create fail\n");
$result = socket_connect($socket, $host, $port) or die("socket_connect fail\n");


echo "Eshte arritur lidhja. \n\n";

while (true){
 