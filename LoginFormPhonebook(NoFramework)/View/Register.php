<?php

$buttonName = array_key_exists('action', $data) ? $data['action'] : 'Register';

if (!array_key_exists('userdata', $data)) {
    $data['userdata']['username'] = '';
    $data['userdata']['first_name'] = '';
    $data['userdata']['last_name'] = '';
    $data['userdata']['email'] = '';
    $data['userdata']['address'] = '';
    $data['userdata']['phone_number'] = '';
}

?>
<?php
if (array_key_exists('error', $data)) {
?>
<span>Error: <?=$data['error']?></span>
<?php } ?>
<form method="POST">
    Username:
    <input type="text" value="<?=$data['userdata']['username']?>" name="username"/><br>
    Password:
    <input type="password" name="password"/><br>
    First Name:
    <input type="text" value="<?=$data['userdata']['first_name']?>" name="first_name"/><br>
    Last Name:
    <input type="text" value="<?=$data['userdata']['last_name']?>" name="last_name"/><br>
    Email:
    <input type="email" value="<?=$data['userdata']['email']?>" name="email"/><br>
    Address:
    <input type="text" value="<?=$data['userdata']['address']?>" name="address"/><br>
    Phone Number:
    <input type="text" value="<?=$data['userdata']['phone_number']?>" name="phone_number"/><br>
    <?php if (array_key_exists('id', $data['userdata'])) { ?>
    <input type="hidden" name="id" value="<?=$data['userdata']['id']?>"/>
    <?php } ?>
    <input type="submit" name="submit" value="<?=$buttonName?>"/>
</form>
