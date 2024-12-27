<?php
// Memanggil file koneksi.php
include_once("config.php");

// Syntax untuk mengambil semua data dari table articles
$result = mysqli_query($con, "select * from articles");
$articles = [];
while ($article = mysqli_fetch_assoc($result)) {
    $articles[] = $article;
}
?>

<html>

<head>
    <title>KayNews</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .article {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
        }

        .article h2 {
            margin: 0;
            font-size: 1.5em;
        }

        .article a {
            text-decoration: none;
            color: #007BFF;
        }

        .article a:hover {
            text-decoration: underline;
        }

        .btn-create {
            display: inline-block;
            padding: 10px 15px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .btn-create:hover {
            background-color: #0056b3;
        }
    </style>
    <script src="script.js" defer></script>
</head>

<body>
    <h1>Articles</h1>
    <input type="text" id="searchInput" placeholder="Search..."></input>
    <button type="button" onclick="performSearch()">Cari</button>
    <div id="search-results"></div>
    <p>
        <a href="create.php" class="btn-create">Buat Artikel Baru</a>
        <a href="delete.php" class="btn-create">Hapus Artikel</a>
    </p>
    <?php foreach ($articles as $article) : ?>
        <div class="article">
            <h2><?= htmlspecialchars($article['title']); ?></h2>
            <p><?= htmlspecialchars(substr(strip_tags($article['body']), 0, 100)) . '...'; ?></p>
            <a href="detail.php?id=<?= $article['id']; ?>">Read More</a>
        </div>
    <?php endforeach; ?>
    <?php if (empty($articles)) : ?>
        <p>Tidak ada artikel</p>
    <?php endif; ?>
</body>

</html>