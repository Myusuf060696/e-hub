<?php 
function username($panjang)
{
    $karakter= '0123456789';
    $string = '';
    for ($i = 0; $i < $panjang; $i++) {
  $pos = rand(0, strlen($karakter)-1);
  $string .= $karakter{$pos};
    }
    return $string;
}
function password($panjang)
{
    $karakter= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789';
    $string = '';
    for ($i = 0; $i < $panjang; $i++) {
  $pos = rand(0, strlen($karakter)-1);
  $string .= $karakter{$pos};
    }
    return $string;
}
//cara memanggilnya
$username = username(10);
$password = password(10);

 ?>