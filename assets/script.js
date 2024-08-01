$(document).ready(function () {
    let tableVisible = false;

    $("#loginForm").on('submit', function (event) {
        event.preventDefault();
        const login = $('#login').val();
        const password = $('#password').val();

        $.post("/src/login.php", { login: login, password: password }, function (response) {
            if (response.auth) {
                location.reload(); 
            } else {
                $('#message').css('color', 'red').html('Неверные логин или пароль');
            }
        }, 'json');
    });

    $("#createUserForm").on('submit', function (event) {
        event.preventDefault();
        $.post("/src/create.php", $(this).serialize(), function(response) {
            if (response.errors) {
                let errorMessages = response.errors.join('<br>');
                $('#message').css('color', 'red').html(errorMessages);
            } else {
                $('#message').css('color', 'green').html(`Пользователь ${response.name} добавлен`);
                if (tableVisible) {
                    refreshTable();
                }
            }
        }, 'json');
    });

    $('#show_users').click(function () {
            refreshTable();
            tableVisible = true;
    });

    $('#reset_user').click(function (){
        $('#tableContainer table').hide();
        $('#delete_user').hide();
        tableVisible = false;
    });

    $('#delete_user').click(function(event) {
        event.preventDefault();

        var checked = [];
        $('input.deleteUser:checked').each(function() {
            checked.push($(this).val());
        });

        if (checked.length === 0) {
            $('#message').css('color', 'red').html("Пожалуйста, выберите хотя бы одного пользователя для удаления.");
            return;
        }

        $.ajax({
            url: 'src/delete.php',
            type: 'POST',
            data: { id: checked },
            success: function() {
                $('#message').css('color', 'green').html('Пользователи успешно удалены');
                if (tableVisible) {
                    refreshTable();
                }
            },
            error: function(error) {
                $('#message').css('color', 'red').html(`Произошла ошибка при удалении пользователей: ${error}`);
            }
        });
    });

    function refreshTable() {
        $.ajax({
            url: '/src/read.php',
            type: 'get',
            dataType: 'html', 
            success: function(data) {
                $('#tableContainer').html(data); 
                $('#tableContainer table').show();
                $('#delete_user').show();
            }         
        });
    }
});
