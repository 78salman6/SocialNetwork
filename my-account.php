<!DOCTYPE html>
<html>
<head>
<style>
.sb {
    background-color: #ff3300;
    border: none;
    color: white;
    padding: 0.5% 2.0%;
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
include('./classes/Image.php');
if (Login::isLoggedIn()) {
        $userid = Login::isLoggedIn();
} else {
        die('Not logged in!');
}

if (isset($_POST['uploadprofileimg'])) {

        Image::uploadImage('profileimg', "UPDATE users SET profileimg = :profileimg WHERE id=:userid", array(':userid'=>$userid));

}
?>
<h1 style="color:#cc0000">My Account</h1>
<form action="my-account.php" method="post" enctype="multipart/form-data">
        Upload a profile image:
        <input type="file" name="profileimg">
        <input type="submit" class="sb" name="uploadprofileimg" value="Upload Image">
</form>
