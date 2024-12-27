<?php
// Memanggil file koneksi.php
include_once("config.php");

// Syntax untuk mengambil semua data dari table articles berdasarkan id
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = mysqli_query($con, "select * from articles where id = $id");
    $article = mysqli_fetch_assoc($result);
    if (!$article) {
        header("Location: index.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Artikel</title>
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
        .article p {
            margin-bottom: 20px;
        }
        .article img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            margin-bottom: 20px;
        }
        .article a {
            text-decoration: none;
            color: #007BFF;
        }
        .article a:hover {
            text-decoration: underline;
        }
        .button {
            display: inline-block;
            padding: 10px 15px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Detail Artikel</h1>
    <a href="index.php" class="button">Kembali</a>
    <div class="article">
        <h2><?php echo htmlspecialchars($article['title']); ?></h2>
        <img src="<?php echo htmlspecialchars($article['image_url']); ?>" alt="<?php echo htmlspecialchars($article['title']); ?>">
        <p><?php echo htmlspecialchars($article['body']); ?></p>
        <p>oleh <a href="#"><?php echo htmlspecialchars($article['author']); ?></a></p>
        <p>kategori: <a href="#"><?php echo htmlspecialchars($article['category']); ?></a></p>
        <p>tanggal: <?php echo htmlspecialchars(date('d-m-Y', strtotime($article['published_at']))); ?></p>
    </div>
    <a href="edit.php?id=<?php echo $article['id']; ?>" class="button" id="edit">Edit Artikel</a>
    <a href="delete.php?id=<?php echo $article['id']; ?>" class="button" id="hapus">Hapus Artikel</a>
<script>
    document.getElementById('hapus').addEventListener('click', function(event) {
        if (!confirm('Apakah Anda yakin ingin menghapus artikel ini?')) {
            event.preventDefault();
        }
    });
</script>

</body>
</html>

