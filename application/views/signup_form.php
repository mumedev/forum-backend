<div id="login_form">
    <fieldset>
        <legend>Login Info</legend>
    <?php
        echo form_open('login_controller/create_member');
        echo form_input('username', set_value('username', 'Username'));
        echo form_password('password', 'Password');
        echo form_password('password2', 'Password2');
    ?>  
    <?php
        echo form_submit('submit', 'Create Account');
    ?>
    <?php
        echo validation_errors('<p class="error">'); // 36:07
    ?>
    </fieldset>
</div>