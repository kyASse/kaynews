<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

// Memanggil file koneksi.php
include_once("config.php");

// Untuk mengambil semua data dari table categories
$result = mysqli_query($con, "select * from categories");
$categories = [];
while ($category = mysqli_fetch_assoc($result)) {
    $categories[$category['id']] = $category['name'];
}

// Untuk mengambil semua data dari table articles
$result = mysqli_query($con, "select * from articles");
$articles = [];
while ($article = mysqli_fetch_assoc($result)) {
    $articles[] = $article;
}
?>
<html>

<head>
    <title>KayNews</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <style>
        .article {
            margin-bottom: 1.5rem;
        }

        .article img {
            width: 100%;
            height: 200px;
            object-fit: cover;
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
<header class="bg-light py-4">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a class="text-decoration-none hover" href="index.php"><h1 class="mb-0 text-secondary">KayNews</h1></a>
            <div>
                <p class="mb-0"><strong><?= $_SESSION['role'] ?></strong></p>
                <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
            </div>
        </div>
        <form action="" method="get" class="mb-3">
            <div class="form-row align-items-center">
                <div class="col-auto">
                    <label for="category" class="mr-2">Kategori:</label>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-outline-primary <?= isset($_GET['category']) ? '' : 'active' ?>">
                            <input type="radio" name="category" id="category-all" value="" <?= isset($_GET['category']) ? '' : 'checked' ?>> Semua
                        </label>
                        <?php foreach ($categories as $id => $name) : ?>
                            <label class="btn btn-outline-primary <?= isset($_GET['category']) && $_GET['category'] == $id ? 'active' : '' ?>">
                                <input type="radio" name="category" id="category-<?= $id ?>" value="<?= $id ?>" <?= isset($_GET['category']) && $_GET['category'] == $id ? 'checked' : '' ?>> <?= $name ?>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="col-auto">
                    <input type="submit" value="Filter" class="btn btn-primary">
                </div>
                <div class="col-auto btn">
                    <a href="create.php" class="btn btn-success">Buat Artikel</a>
                </div>
            </div>
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
        <div class="input-group mb-3">
            <input type="text" id="searchInput" class="form-control" placeholder="Search...">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button" onclick="performSearch()">Cari</button>
            </div>
        </div>
    </div>
</header>
    <div class="container mt-3">
        <div id="search-card">
            <div>
                <h5 class="card-title">Hasil Pencarian</h5>
            </div>
            <div id="search-results" class="card mb-3">
                <div class="card-body">
                    <div id="search-results-list" class="list-group"></div>
                </div>
            </div>
        </div>
        <?php foreach ($articles as $article) : ?>
            <div class="article card mb-3">
                <img src="<?= htmlspecialchars($article['image_url']); ?>" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($article['title']); ?></h5>
                    <p class="card-text"><?= htmlspecialchars(substr(strip_tags($article['body']), 0, 100)) . '...'; ?></p>
                    <p class="card-text"><small class="text-muted">oleh <?= htmlspecialchars($article['author_id']); ?> pada <?= htmlspecialchars(date('d-m-Y', strtotime($article['published_at']))); ?></small></p>
                    <a href="detail.php?id=<?= $article['id']; ?>" class="btn btn-primary">Read More</a>
                </div>
            </div>
        <?php endforeach; ?>
        <?php if (empty($articles)) : ?>
            <p>Tidak ada artikel</p>
        <?php endif; ?>
    </div>
</body>

</html>


