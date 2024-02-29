<?php
include 'functions.php';

// Проверяем, есть ли GET-параметр title
if (isset($_GET['title'])) {
    // Получаем название статьи из GET-параметра
    $title = $_GET['title'];

    // Формируем имя файла
    $filename = "articles/$title.md";

    // Проверяем существование файла
    if (file_exists($filename)) {
        // Читаем содержимое файла
        $content = file_get_contents($filename);
    } else {
        // Если файл не существует, устанавливаем пустое содержимое
        $content = "";
    }
} else {
    // Если GET-параметр title не задан, устанавливаем пустое название и содержимое
    $title = "";
    $content = "";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Article</title>
</head>
<body>
<h1>Edit Article - <?php echo $title; ?></h1>
<form action="index.php" method="POST">
    <input type="hidden" name="title" value="<?php echo $title; ?>">
    <textarea name="content" cols="80" rows="20"><?php echo $content; ?></textarea><br>
    <input type="submit" value="Save Changes">
</form>
</body>
</html>
