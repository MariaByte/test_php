<table id="userTable" style="display: none;">
    <thead>
    <tr>
        <th></th>
        <th>id</th>
        <th>Имя</th>
        <th>Email</th>
        <th>Время создания</th>
        <th>Пароль</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($users as $user) {?>
        <tr>
        <td><input type="checkbox" class="deleteUser" value="<?=$user['id']?>"></td>
        <td><?=$user['id']?></td>
        <td><?=$user['name']?></td>
        <td><?=$user['email']?></td>
        <td><?=$user['created_at']?></td>
        <td><?=$user['password']?></td>
    </tr>
    <?php } ?>
    </tbody>
</table>