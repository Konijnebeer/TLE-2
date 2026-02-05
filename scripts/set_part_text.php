<?php
$db = new PDO('sqlite:database/database.sqlite');
$id = $argv[1] ?? null;
if (!$id) { echo "Usage: php set_part_text.php <id>\n"; exit(1); }
$stmt = $db->prepare('update parts set type = :type, options = :options, correct_answer = :correct where id = :id');
$stmt->execute([':type' => 'text', ':options' => null, ':correct' => null, ':id' => $id]);
echo "Updated part $id to type=text\n";

