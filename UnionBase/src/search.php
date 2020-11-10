<?php
set_time_limit(2);

$db = new mysqli('db', 'root', $_ENV['MYSQL_ROOT_PASSWORD'], 'sqllab');

// echo 'SELECT id, name, email, status FROM user WHERE id = ' . addslashes($_POST['userid']);
if (strpos($_POST['userid'], '\'') !== false) die('DONT TRY TO HACK');
if (strpos(strtolower($_POST['userid']), 'concat') !== false) die('DONT TRY TO HACK');
if (strpos(strtolower($_POST['userid']), 'sleep') !== false) die('DONT TRY TO HACK');
if (strpos(strtolower($_POST['userid']), ' or ') !== false) die('DONT TRY TO HACK');
if (strpos(strtolower($_POST['userid']), '--') !== false) die('DONT TRY TO HACK');
if (strpos(strtolower($_POST['userid']), '#') !== false) die('DONT TRY TO HACK');
$q = $db->query('SELECT id, name, email, status FROM user WHERE id = ' . addslashes($_POST['userid']));
if ($q->num_rows == 0) die('No data');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search result</title>
</head>

<body>
    <?php
    echo 'ผลการค้นหา ' . $_POST['userId'];
    ?>
    <table>
        <tr>
            <th>id</th>
            <th>name</th>
            <th>email</th>
            <th>status</th>
        </tr>
        <?php
        while ($obj = $q->fetch_object()) {
        ?>
            <tr>
                <td><?php echo $obj->id; ?></td>
                <td><?php echo $obj->name; ?></td>
                <td><?php echo $obj->email; ?></td>
                <td><?php echo $obj->status; ?></td>
            </tr>
        <?php
        }
        ?>
    </table>
</body>

</html>