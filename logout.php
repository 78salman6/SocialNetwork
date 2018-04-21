<!DOCTYPE html>
<html>
<head>
<style>
.button {
    background-color: #ff3300;
    border: none;
    color: white;
    padding: 0.7% 2.1%;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
}
</style>
</head>
<?php
include('./classes/DB.php');
include('./classes/Login.php');
$p=Login::isLoggedIn();
//echo "Loggedin user=".$p;
if (!Login::isLoggedIn()) {
        die("Not logged in.");
}

if (isset($_POST['confirm'])) {

        if (isset($_POST['alldevices'])) {

                DB::query('DELETE FROM login_tokens WHERE user_id=:userid', array(':userid'=>Login::isLoggedIn()));

        } else {
                if (isset($_COOKIE['SNID'])) {
                        DB::query('DELETE FROM login_tokens WHERE token=:token', array(':token'=>sha1($_COOKIE['SNID'])));
                }
          setcookie('SNID', '1', time()-3600);
          setcookie('SNID_', '1', time()-3600);
        }

}

?>
<h1 style="color:#00ccff;">Logout of your Account?</h1>
<h4>Are you sure you'd like to logout?</h4>
<form action="logout.php" method="post">
        <input type="checkbox" name="alldevices" value="alldevices"> Logout of all devices?<br />
        <input type="submit" class="button" name="confirm" value="Confirm">
</form>
