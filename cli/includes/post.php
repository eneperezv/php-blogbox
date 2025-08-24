<?php

/*
 * @(#)post.php 1.0 30/11/2024
 * 
 * El código implementado en este formulario esta protegido
 * bajo las leyes internacionales del Derecho de Autor, sin embargo
 * se entrega bajo las condiciones descritas en The MIT License (MIT)  
 * en https://opensource.org/license/mit
 */

/**
 * @author eliezer.navarro
 * @version 1.0
 * @since 1.0
 */

$post = fetchPostById($_SESSION['token'],$_GET['id']); // Obtener post desde la API
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title><?= htmlspecialchars($post['title']) ?></title>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container mt-4">
        <h1><?= htmlspecialchars($post['title']) ?></h1>
        <p>Por <a href="index.php?action=author&id=<?= $post['author_id'] ?>"><?= htmlspecialchars($post['author_name']) ?></a></p>
        <p><?= htmlspecialchars($post['content']) ?></p>
        <p>👍 <?= $post['upvote_count'] ?> 👎 <?= $post['downvote_count'] ?> 💬 <?= $post['comment_count'] ?></p>
        <div class="mt-4">
            <button class="btn btn-success">👍 Upvote</button>
            <button class="btn btn-danger">👎 Downvote</button>
        </div>
        <div class="mt-4">
            <form action="index.php?action=comment&id=<?= $post['id'] ?>" method="post">
                <textarea name="comment" class="form-control mb-2" rows="3" placeholder="Escribe tu comentario"></textarea>
                <button type="submit" class="btn btn-primary">Enviar comentario</button>
            </form>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
