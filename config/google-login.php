<?php

$clientId = '5292825064-la52gccqjbr77teq2gdhmt14snnavrb4.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUrl = 'http://localhost:8080/login';

 global $client;
 $client = new Google_Client();
$client->setClientId($clientId);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUrl);
$client->setApprovalPrompt('force');
$client->addScope('profile');
$client->addScope('email');