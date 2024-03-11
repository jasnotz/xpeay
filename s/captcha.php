<?php
	error_reporting(0);
/* 자동가입방지 문자*/
	session_start();
	header('Content-Type: image/gif');

	$captcha = '';

	/*패턴*/
	$patten = '123456789QWEERTYUIOPASZDFGHJKLZMXNCBVqpwoeirutyalskdjfhgzmxncbv'; //패턴 설정
	for($i = 0, $len = strlen($patten) -1; $i < 6; $i++){ //6가지 문자 생성
		$captcha .= $patten[rand(0, $len)];
	}

	$_SESSION['capt'] = $captcha;
	
	$img = imagecreatetruecolor(60, 20); //크기
	imagefilledrectangle($img, 0,0,100,100,0xc80000); // 배경색
	imagestring($img, 5, 3, 3, $captcha, 0xffffff); //문자 여백, 문자색상
	imageline($img,0,rand() % 20,100,rand() % 20, 0x001458); //줄 색상 
	imagegif($img);
	imagedestroy($img);
?>