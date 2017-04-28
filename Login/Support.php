<?php

require_once "./assets/passwordLib.php";

class User {
	public $username = ''; /* Users' username */
	public $hash = ''; /* Hash of password */
	public $type = ''; /*admin or customer*/
	public $email = ''; /*User's email address*/
}
function makeNewUser($uname, $h, $type, $mail) {
	$u = new User ();
	$u->username = $uname;
	$u->hash = $h;
	$u->type = $type;
	$u->email = $mail;
	return $u;
}
function setupDefaultUsers() {
	$users = array ();
	$i = 0;
	$users [$i ++] = makeNewUser ( 'cschulze', '$2a$10$BJVO4nnxUVbBeQy4Cy0KpuRevFLeTcjOatFWYKFJhAYVvD5DSGKLS', 'admin', 'cschulze@colostate.edu' );
	$users [$i ++] = makeNewUser ( 'jcollera', '$2a$10$JI9LAwNZirkUaCVhg3nGKOzkyFWXqKOD4Ebo9ImEFuC2u0w0ts9eC', 'admin', 'jakecollera@hotmail.com' );
	$users [$i ++] = makeNewUser ( 'testAccount', '$2a$10$JDIlTACGE/yyJCo/1CkYp.LRp8MdfklYUiktJzxTCwSuHTYznw9GS', 'customer', 'schulzecb@gmail.com'); /*test account - password is: testing123*/
	//ct310 accounts
	$users [$i ++] = makeNewUser ( 'ct310', '$2a$10$AoWRyJ/EvpnVfchrezeTKuzJBYBomjiG3AszuFw2mvWAvJf2APojO', 'admin', 'ct310@cs.colostate.edu'); //Password: A835E0
	$users [$i ++] = makeNewUser ( 'fred', '$2a$10$Y76zJIpHLeX0QebDWcdxRuFiJJSnMzuco1l.okkSPtdh.t6dRvE.2', 'customer', 'ct310@cs.colostate.edu'); //Password: 3B23E6
	writeUsers ( $users );
}
function writeUsers($users) {
	$fh = fopen ( 'users.csv', 'w+' ) or die ( "Can't open file" );
	fputcsv ( $fh, array_keys ( get_object_vars ( $users [0] ) ) );
	for($i = 0; $i < count ( $users ); $i ++) {
		fputcsv ( $fh, get_object_vars ( $users [$i] ) );
	}
	fclose ( $fh );
}
function readUsers() {
	if (! file_exists ( 'users.csv' )) {
		setupDefaultUsers ();
	}
	$users = array ();
	$fh = fopen ( 'users.csv', 'r' ) or die ( "Can't open file" );
	$keys = fgetcsv ( $fh );
	while ( ($vals = fgetcsv ( $fh )) != FALSE ) {
		if (count ( $vals ) > 1) {
			$u = new User ();
			for($k = 0; $k < count ( $vals ); $k ++) {
				$u->$keys [$k] = $vals [$k];
			}
			$users [] = $u;
		}
	}
	fclose ( $fh );
	return $users;
}
function userHashByName($users, $uname) {
	$res = '';
	foreach ( $users as $u ) {
		if ($u->username == $uname) {
			$res = $u->hash;
		}
	}
	return $res;
}

function isAdmin($user) {
    if (isset($_SESSION['userName']) && $_SESSION['userName'] == "Guest") {
        return false;
    }
    else if($user->type == "admin") {
        return true;
    }
    else
        return false;

}

function isCustomer($user) {
    if (isset($_SESSION['userName']) && $_SESSION['userName'] == "Guest") {
        return false;
    }
    else if($user->type == "customer") {
        return true;
    }
    else
        return false;

}
?>
