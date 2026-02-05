<?php
$db=new PDO('sqlite:database/database.sqlite');
$id = $argv[1] ?? null;
if (!$id) { echo "Usage: php update_and_dump_part.php <id>\n"; exit(1); }
// Update to text and clear options/correct_answer
$stmt = $db->prepare('update parts set type = :type, options = :options, correct_answer = :correct where id = :id');
$stmt->execute([':type'=>'text', ':options'=>null, ':correct'=>null, ':id'=>$id]);
// Fetch row
$row = $db->query('select id, type, options, correct_answer, success_condition from parts where id=' . (int)$id)->fetch(PDO::FETCH_ASSOC);
echo json_encode($row, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "\n";

