<?php
require 'vendor/autoload.php';

use Cake\Auth\DefaultPasswordHasher;

$hasher = new DefaultPasswordHasher();
$hash = $hasher->hash('adecoagro');

echo "El hash bcrypt es: " . $hash . PHP_EOL;
//Abrir un bash dentro de la carpeta principal del proyecto "AdecoAGRO". Ejecutar el siguiente comando: php para_hashear_password.php
//Con eso te va a tirar la contraseña hasheada, luego agregas el usuario dentro de la tabla y en el password agregas dicho codigo hash.