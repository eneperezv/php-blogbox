<?php
$posts = fetchPosts($_SESSION['token']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Inicio</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container mt-4">
        <h1>Posts Recientes</h1>
        <div class="row">
            <?php foreach ($posts as $post): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($post['title']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars(substr($post['content'], 0, 50)) ?>...</p>
                            <p class="text-muted">Por <a href="index.php?action=author&id=<?= $post['author_id'] ?>"><?= htmlspecialchars($post['author_name']) ?></a></p>
                            <p>👍 <?= $post['upvote_count'] ?> 👎 <?= $post['downvote_count'] ?> 💬 <?= $post['comment_count'] ?></p>
                            <a href="index.php?action=post&id=<?= $post['id'] ?>" class="btn btn-primary">Seguir leyendo</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
