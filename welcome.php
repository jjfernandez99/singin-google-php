<?php
require_once 'config.php';
require_once 'vendor/autoload.php';

// authenticate code from Google OAuth Flow
if (isset($_GET['code'])) 
{
  $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
  $client->setAccessToken($token['access_token']);

  // get profile info
  $google_oauth = new Google_Service_Oauth2($client);
  $google_account_info = $google_oauth->userinfo->get();
  $userinfo = [
    'email' => $google_account_info['email'],
    'first_name' => $google_account_info['givenName'],
    'last_name' => $google_account_info['familyName'],
    'gender' => $google_account_info['gender'],
    'full_name' => $google_account_info['name'],
    'picture' => $google_account_info['picture'],
    'verifiedEmail' => $google_account_info['verifiedEmail'],
    'token' => $google_account_info['id'],
  ];

  // save user data into session
  $_SESSION['user_token'] = $token;
}
 else 
{
  if (!isset($_SESSION['user_token'])) {
    header("Location: redirect.php");
die();
  }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome</title>
</head>

<body>
<img src="<?= $userinfo['picture'] ?>" alt="" width="90px" height="90px">
  <ul>
<li>First Name: <?= $userinfo['first_name'] ?></li>
<li>Last Name: <?= $userinfo['last_name'] ?></li>
<li>verifiedEmail: <?= $userinfo['verifiedEmail'] ?></li>
    <li>Full Name: <?= $userinfo['full_name'] ?></li>
    <li>Email Address: <?= $userinfo['email'] ?></li>
    <li>Gender: <?= $userinfo['gender'] ?></li>
    <li><a href="logout.php">Logout</a></li>
  </ul>
</body>

</html>
