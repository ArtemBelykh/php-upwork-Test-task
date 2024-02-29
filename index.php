<?php include 'functions.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles</title>
</head>
<body>
<h1>List of Articles</h1>
<?php if (!empty($articles)): ?>
    <table border="1">
        <tr>
            <th>Title</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($articles as $article): ?>
            <tr>
                <td><?php echo $article['title']; ?></td>
                <td><a href="edit.php?title=<?php echo urlencode($article['title']); ?>">Edit</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>No articles found.</p>
<?php endif; ?>
</body>
</html>