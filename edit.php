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

// Syntax untuk mengupdate data pada table articles
if (isset($_POST['update'])) {
    $title = $_POST['title'];
    $body = $_POST['body'];
    $category_id = $_POST['category'];
    $author_id = $_POST['author'];
    $image_url = $_POST['image_url'] ? $_POST['image_url'] : $article['image_url'];

    $result = mysqli_query($con, "update articles set title = '$title', body = '$body', category_id = '$category_id', author_id = '$author_id', image_url = '$image_url' where id = $id");
    if ($result) {
        header("Location: detail.php?id=$id");
        exit();
    } else {
        echo "Gagal mengupdate data";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Artikel</title>
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
    </style>
</head>
<body>
    <h1>Edit Artikel</h1>
    <form method="post" action="">
        <div class="article">
            <h2><input type="text" name="title" value="<?php echo htmlspecialchars($article['title']); ?>"></h2>
            <img src="<?php echo htmlspecialchars($article['image_url']); ?>" alt="<?php echo htmlspecialchars($article['title']); ?>">
            <p><textarea name="body" cols="30" rows="10"><?php echo htmlspecialchars($article['body']); ?></textarea></p>
            <p>
                Kategori: 
                <select name="category">
                    <option value="Nasional" <?php echo $article['category'] == 'Nasional' ? 'selected' : ''; ?>>Nasional</option>
                    <option value="Internasional" <?php echo $article['category'] == 'Internasional' ? 'selected' : ''; ?>>Internasional</option>
                    <option value="Ekonomi" <?php echo $article['category'] == 'Ekonomi' ? 'selected' : ''; ?>>Ekonomi</option>
                    <option value="Teknologi" <?php echo $article['category'] == 'Teknologi' ? 'selected' : ''; ?>>Teknologi</option>
                    <option value="Olahraga" <?php echo $article['category'] == 'Olahraga' ? 'selected' : ''; ?>>Olahraga</option>
                    <option value="Hiburan" <?php echo $article['category'] == 'Hiburan' ? 'selected' : ''; ?>>Hiburan</option>
                </select>
            </p>
            <p>Author ID: <input type="number" name="author" value="<?php echo htmlspecialchars($article['author']); ?>"></p>
            <p>Image URL: <input type="text" name="image_url" value="<?php echo htmlspecialchars($article['image_url']); ?>"></p>
            <p><input type="submit" name="update" value="Update"></p>
        </div>
    </form>
</body>
</html>
