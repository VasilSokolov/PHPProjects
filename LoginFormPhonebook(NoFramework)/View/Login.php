<?php

?>

<form method="POST">
    Username:
    <input type="text" name="username"/><br>
    Password:
    <input type="password" name="password"/><br>
    <input type="submit" name="submit" value="Login"/>
</form>
<?php
if (array_key_exists('error', $data)) {
?>
<span>Error: <?=$data['error']?></span>
<?php } ?>

<a href="?action=create"> Register </a>

