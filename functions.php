<?php
function saveChanges($title, $oldContent, $newContent) {
    $auditLog = fopen("audit.log", "a");

    // Расчет изменений в тексте
    $oldWords = str_word_count($oldContent);
    $newWords = str_word_count($newContent);
    $wordDiff = $newWords - $oldWords;

    // Поиск таблиц и изображений
    $oldTables = substr_count($oldContent, '|');
    $newTables = substr_count($newContent, '|');
    $tableDiff = $newTables - $oldTables;

    $oldImages = substr_count($oldContent, '![');
    $newImages = substr_count($newContent, '![');
    $imageDiff = $newImages - $oldImages;

    // Запись в аудит лог
    fwrite($auditLog, "Article: $title\n");
    fwrite($auditLog, "Word Diff: $wordDiff\n");
    fwrite($auditLog, "Table Diff: $tableDiff\n");
    fwrite($auditLog, "Image Diff: $imageDiff\n\n");

    fclose($auditLog);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title']) && isset($_POST['content'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $filename = "articles/$title.md";
    if (file_exists($filename)) {
        $oldContent = file_get_contents($filename);
        file_put_contents($filename, $content);
        saveChanges($title, $oldContent, $content);
        echo "Changes saved successfully!";
    } else {
        echo "Article not found!";
    }
    exit;
}



// Чтение и вывод списка стате
function readArticles() {
    $articles = [];
    $files = glob("articles/*.md");
    foreach ($files as $file) {
        $article = [
            'title' => htmlspecialchars(basename($file, '.md')), // Обработка HTML спецсимволов
            'content' => file_get_contents($file)
        ];
        $articles[] = $article;
    }
    return $articles;
}
$articles = readArticles();
