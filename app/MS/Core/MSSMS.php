<?php

namespace MS\Core;

class MSSMS {

	public static 




	$user = $_POST['user'];
 $senderid = '9bb90d43-7f4e-47b4-92e3-7f9f4fce36bd';
 $channel = '2';
 $DCS = '0';
 $flashsms = '0';
 $number = '9662611234';
 $message = "your verification code is ".str_random(4);
 $route = '';

$ch=curl_init('http://login.smsgatewayhub.com/api/mt/SendSMS?APIKey='.$_POST['user'].'&senderid='.$_POST
['senderid'].'&channel='.$_POST['channel'].'&DCS='.$_POST['number'].'&flashsms='.$_POST['flashsms'].'&numb
er='.$_POST['number'].'&text='.$_POST['message'].'&route='.$_POST['route'].';');
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
 curl_setopt($ch,CURLOPT_POST,1);
 curl_setopt($ch,CURLOPT_POSTFIELDS,"");
 curl_setopt($ch, CURLOPT_RETURNTRANSFER,2);
 $data = curl_exec($ch);

}