<?php

$dbPath = __DIR__ . '/banco.sqlite';

$pdo = new PDO("sqlite:$dbPath");

$url = filter_input(INPUT_POST, $_POST['url'], FILTER_VALIDATE_URL);
$titulo = filter_input(INPUT_POST, $_POST['titulo']);
if ($url === false || $titulo === false) {
    header('Location: /index.php?sucesso=0');
    exit();
}

$sql = 'INSERT INTO videos (url, title) VALUES (?, ?)';
$statement = $pdo->prepare($sql);
$statement->bindValue(1, $url);
$statement->bindValue(2, $titulo);

if ($statement->execute() === false) {
    header('Location: /index.php?sucesso=0');
} else {
    header('Location: /index.php?sucesso=1');
}
