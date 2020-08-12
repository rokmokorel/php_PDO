<?php
$host = 'localhost';
$user = 'root';
$password = '****';
$dbname = 'pdo_posts';

// DSN
$dsn = 'mysql:host=' . $host . ';dbname=' . $dbname;

// PDO instance
$pdo = new PDO($dsn, $user, $password);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

// PDO Query
$statement = $pdo->query('SELECT * FROM posts');

while ($row = $statement->fetch()) {
  echo $row->title . '<br>';

  // prepare and execute
  $bool = 1;
  // $sql = 'SELECT * FROM posts WHERE published = ?';
  // $statement = $pdo->prepare($sql);
  // $statement->execute([$bool]);
  // $posts = $statement->fetchAll();

  $sql = 'SELECT * FROM posts WHERE published = :id';
  $statement = $pdo->prepare($sql);
  $statement->execute(["id" => $bool]);
  $posts = $statement->fetchAll();

  foreach ($posts as $post) {
    echo $post->author . " : ";
    echo $post->title . '<br>';
  }

  // ADD data
  $title = "Umor na orient express";
  $body = "Kriminalka, zelo napeta";
  $author = "Agatha Christie";

  $sql = 'INSERT INTO posts(title, body, author) VALUES (:title, :body, :author)';
  $statement = $pdo->prepare($sql);
  $statement->execute(["title" => $title, "body" => $body, "author" => $author]);
  echo "dodana vrstica";
}
