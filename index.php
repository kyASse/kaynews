<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

// Memanggil file koneksi.php
include_once("config.php");

// Syntax untuk mengambil semua data dari table categories
$result = mysqli_query($con, "select * from categories");
$categories = [];
while ($category = mysqli_fetch_assoc($result)) {
    $categories[$category['id']] = $category['name'];
}

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
    <p>anda login sebagai <?= $_SESSION['role'] ?><a href="logout.php" class="btn-create">Logout</a></p>
    
    <form action="" method="get">
        <label for="category">Kategori:</label>
        <select name="category" id="category">
            <option value="">Semua</option>
            <?php foreach ($categories as $id => $name) : ?>
                <option value="<?= $id ?>" <?= isset($_GET['category']) && $_GET['category'] == $id ? 'selected' : '' ?>><?= $name ?></option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Filter">
    </form>
    
    <?php if (isset($_GET['category']) && $_GET['category'] != '') : ?>
        <?php $category_id = $_GET['category']; ?>
        <?php $result = mysqli_query($con, "select * from articles where category_id = $category_id"); ?>
        <?php $articles = []; ?>
        <?php while ($article = mysqli_fetch_assoc($result)) : ?>
            <?php $articles[] = $article; ?>
        <?php endwhile; ?>
    <?php else : ?>
        <?php $result = mysqli_query($con, "select * from articles"); ?>
        <?php $articles = []; ?>
        <?php while ($article = mysqli_fetch_assoc($result)) : ?>
            <?php $articles[] = $article; ?>
        <?php endwhile; ?>
    <?php endif; ?>
    
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

