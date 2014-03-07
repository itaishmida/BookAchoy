<h1>ahhhhhhhhhhhhhhh</h1>
<table>
    <thead>
    <th>id</th>
    <th>First name</th>
    <th>Last name</th>
    </thead>
    <tbody>
    <?php
    foreach($users as $user)
    {
        ?>
        <tr>
            <td><?php echo $user['id'] ?></td>
            <td><?php echo $user['fname'] ?></td>
            <td><?php echo $user['lname'] ?></td>
        </tr>


    <?php
    }
?>
    </tbody>
</table>