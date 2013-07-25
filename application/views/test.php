<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Test view</title>
    </head>
    <body>
        <h1>Hello World!</h1>
        <?php
            foreach ($rows as $row) :
        ?>
        <p><?php echo $row->name; ?></p>
        <?php
            endforeach;
        ?>
    </body>
</html>
