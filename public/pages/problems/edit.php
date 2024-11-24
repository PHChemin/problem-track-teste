<?php

require '/var/www/app/models/Problem.php';

$id = intval($_GET['id']);


$problem = Problem::findById($id);

$title = "Editar o Problema #{$id}";

$view = '/var/www/app/views/problems/edit.phtml';

require '/var/www/app/views/layouts/application.phtml';