<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Test CRUD</title>
    </head>
    <body>
        <h1>CRUD</h1>
        
        <h2>Create</h2>
        
        
        
        
        <h2>Read</h2>
        
        <table>
            <thead>
                <tr>
                    <td>NAME</td>
                    <td></td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
        <?php
            foreach ($rows as $row) :
        ?>
                <tr>
                    <td><?php echo $row->name; ?></td>
                    <td>
                        <?php echo form_open('delete' . $row->name)
                                . form_submit('delete', 'DELETE')
                                . form_close();
                        ?>
                    </td>
                    <td><button>EDIT</button></td>
                </tr>
        <?php
            endforeach;
        ?>
            </tbody>
        </table>
    </body>
</html>
