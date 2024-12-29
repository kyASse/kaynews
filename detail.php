<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
// Get article data from database
$article = getArticle($_GET['id'] ?? null);

if (!$article) {
    header("Location: index.php");
    exit;
}

// Get categories from database
$categories = getCategories();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Artikel</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color:rgb(255, 255, 255);
        }
        .article {
            margin-top: 20px;
        }
        .article img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <header class="bg-light py-4">
        <div class="container">
            <?php include_once('header.php'); ?>
        </div>
    </header>
    <div class="container">
        <a href="index.php" class="btn btn-primary mt-3">Kembali</a>
        <div class="card article">
            <div class="card-body">
                <h2 class="card-title"><?= htmlspecialchars($article['title']); ?></h2>
                <img src="<?= htmlspecialchars($article['image_url']); ?>" alt="<?= htmlspecialchars($article['title']); ?>" class="card-img-top">
                <p class="card-text"><?= htmlspecialchars($article['body']); ?></p>
                <p class="card-text"><small class="text-muted">oleh: <?= htmlspecialchars($article['author_id']); ?></small></p>
                <p class="card-text">kategori: <a href="index.php?category=<?= $categories[$article['category_id']] ?>" class="text-primary"><?= $categories[$article['category_id']] ?></a></p>
                <p class="card-text"><small class="text-muted">tanggal: <?= htmlspecialchars(date('d-m-Y', strtotime($article['published_at']))); ?></small></p>
            </div>
        </div>
        <div class="mt-3 mb-3">
            <a href="edit.php?id=<?= $article['id']; ?>" class="btn btn-warning">Edit Artikel</a>
            <a href="cetak_artikel.php?id=<?= $article['id']; ?>" class="btn btn-success">Unduh Artikel</a>
            <a href="delete.php?id=<?= $article['id']; ?>" class="btn btn-danger" id="hapus">Hapus Artikel</a>
        </div>
    </div>

    <script>
        document.getElementById('hapus').addEventListener('click', function(event) {
            if (!confirm('Apakah Anda yakin ingin menghapus artikel ini?')) {
                event.preventDefault();
            }
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php

/**
 * Get article data from database
 *
 * @param int $id
 * @return array|null
 */
function getArticle($id)
{
    $con = connectDB();
    $result = mysqli_query($con, "SELECT * FROM articles WHERE id = $id");
    $article = mysqli_fetch_assoc($result);
    mysqli_close($con);
    return $article;
}

/**
 * Get categories from database
 *
 * @return array
 */
function getCategories()
{
    $con = connectDB();
    $result = mysqli_query($con, "SELECT * FROM categories");
    $categories = [];
    while ($category = mysqli_fetch_assoc($result)) {
        $categories[$category['id']] = $category['name'];
    }
    mysqli_close($con);
    return $categories;
}

/**
 * koneksi ke database
 *
 * @return resource
 */
function connectDB()
{
    $con = mysqli_connect("localhost", "root", "", "portal_berita");
    if (!$con) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }
    return $con;
}