<?php

require_once('sql_formatter.php');

require_once("DATABASE_SETTINGS.php");
mysql_connect(SERVER, USERNAME, PASSWORD) or die(mysql_error());
mysql_select_db(DATABASE) or die(mysql_error());
$result = mysql_query("SELECT statement FROM _log ORDER BY timestamp LIMIT 10");
while($row = mysql_fetch_array( $result )) {
	$statements[] = $row['statement'];
}
?>

<table>
    <tr>
        <th>SQL Log</th>
    </tr>
    <?php foreach ($statements as $sql) { ?>
    <tr>
        <td><?php echo SqlFormatter::format($sql); ?></td>
    </tr>
    <?php }    ?>
</table>