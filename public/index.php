<?php
/**
 * Created by PhpStorm.
 * User: Dell_PC
 * Date: 7/31/2019
 * Time: 22:18
 */

include_once __DIR__."/../vendor/autoload.php";
use Event\Emiter as Emiter;

$emiter =  Emiter::getInstance();
$emiter->on('user.deleted',function($user){
    print "L'utilisateur $user vient d'etre supprimé ";
});

$emiter->on('user.created',function($user){
    print "L'utilisateur $user vient d'etre créé ";
});

$emiter->emit('user.created','MHA');
$emiter->emit('user.created','MHA1');
$emiter->emit('user.deleted','Louay');

