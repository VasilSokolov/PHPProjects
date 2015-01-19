<?php 
?>

<h1> Users </h1>


<table>
    <thead>
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Address</th>
            <th>Phone Number</th>
            <th>Actions</th>
        </tr>
    </thead>
    <?php foreach ($data['users'] as $user) {
     /* @var $user User */
    ?>
    <tr>
        <td><?=$user->getUsername()?></td>
        <td><?=$user->getEmail()?></td>
        <td><?=$user->getFirstName()?></td>
        <td><?=$user->getLastName()?></td>
        <td><?=$user->getAddress()?></td>
        <td><?=$user->getPhoneNumber()?></td>
        <?php if ($user->getUsername()!='admin') { ?>
        <th><a onclick="return confirm('Are you sure?')" href="?action=delete&id=<?=$user->getId()?>"?>Delete</a></th>
        <?php } ?>
    </tr>
    <?php } ?>

</table>

<br/><br/>
<a href="?action=logout"> Logout </a>