<?php

error_reporting(E_ALL);
session_start();

include 'utility.php';

include '../application/bootstrap.php';

echo "<br clear='all' />";
echo "<br />";
echo "<br />";

printr($registry, 'Registry');
echo "<br clear='all' />";
printr(get_included_files(), 'Included Files');