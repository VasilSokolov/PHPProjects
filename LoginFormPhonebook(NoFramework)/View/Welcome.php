<?php 
?>

<h1>Welcome <?=$data['user']->getFirstName()?></h1>

<br/><br/>
<a href="?action=logout"> Logout </a>
<br/>
<a href="?action=update"> Edit your profile </a>
<br/>
<?php if ($data['user']->getUsername() == 'admin') { ?>
<a href="?action=listUsers"> List registered users </a>
<?php } ?>
