<?php
$db=new PDO('sqlite:database/database.sqlite');
$id = $argv[1] ?? 11;
$row=$db->query("select * from parts where id=$id")->fetch(PDO::FETCH_ASSOC);
echo json_encode($row, JSON_PRETTY_PRINT);

