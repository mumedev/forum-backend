<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Test EMAIL</title>
    </head>
    <body>
        <h1>Sending Email</h1>
        
        <?php
        
            echo form_open('test/send_email');
            
            $name_data = array(
                'name'  => 'name',
                'id'    => 'name',
                'value' => set_value('name')
            );
            $email_data = array(
                'name'  => 'email',
                'id'    => 'email',
                'value' => set_value('email')
            );            
        ?>
        <p>
            <label for="name">Name:</label>
            <?php echo form_input($name_data); ?>
        </p>
        <p>
            <label for="email">Email Address:</label>
            <?php echo form_input($email_data); ?>
        </p>
        
    </body>
</html>
