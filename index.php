<?php
session_start();
$auth = isset($_SESSION['auth']) && $_SESSION['auth'];

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: /'); 
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/styles.css">
    <title>Document</title>
</head>
<body>
<?php if (!$auth) { ?>
<div id="authBlock">
<h2>Авторизация</h2>
<p>Введите admin/admin</p>
<form method="post" id="loginForm">
    <p>Логин</p>
    <input type="text" name="login" id="login" placeholder="Введите логин">
    <p>Пароль</p>
    <input type="password" name="password" id="password" placeholder="*****">
    <button type="submit" id="auth">Войти</button>
</form>
</div>
<?php } else {?>
    <div id="userManagement">
    <a href="?logout=true" id="logout">Выйти</a>
<h3>Добавление пользователя</h3>
<form method="post" id="createUserForm">
    <p>Имя</p>
    <input type="text" name="name" id="name" placeholder="Введите имя">
    <p>Email</p>
    <input type="email" name="email" id="email" placeholder="Введите email">
    <p>Пароль</p>
    <input type="password" name="password" id="password" placeholder="*****">
    <button id="create_user">Создать</button>
</form>

<div>
    <button type="submit" id="show_users">Показать</button>
    <button type="submit" id="reset_user">Скрыть</button>
</div>

<div id="tableContainer"></div>
<button hidden type="submit" id="delete_user">Удалить</button>

</div>
<?php }?>
<div id="message"></div>
<script src="https://ajax.aspnetcdn.com/ajax/jquery/jquery-1.9.0.min.js"></script>
<script src="/assets/script.js"></script>
</body>
</html>