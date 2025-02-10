<?php

$db_type = 'mysql'; // or 'mssql'

switch ($db_type) {
    case 'mysql':
        $db_host = 'your_mysql_host';
        $db_name = 'your_mysql_db_name';
        $db_user = 'your_mysql_user';
        $db_pass = 'your_mysql_password';
        break;
    case 'mssql':
        $db_host = 'your_mssql_host';
        $db_name = 'your_mssql_db_name';
        $db_user = 'your_mssql_user';
        $db_pass = 'your_mssql_password';
        break;
    default:
        die("Invalid database type.");
}?>