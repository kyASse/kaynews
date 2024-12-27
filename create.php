<?php
// Memanggil file koneksi.php
include_once("config.php");

// Syntax untuk menambahkan data baru ke table articles
if (isset($_POST['create'])) {
    $title = $_POST['title'];
    $body = $_POST['body'];
    $category_id = $_POST['category'];
    $author_id = $_POST['author'];
    $image_url = $_POST['image_url'];
    $result = mysqli_query($con, "insert into articles (title, body, category_id, author_id, image_url) values ('$title', '$body', '$category_id', '$author_id', '$image_url')");
    if ($result) {
        header("Location: index.php");
        exit();
    } else {
        echo "Gagal menambahkan data" . mysqli_error($con);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Artikel Baru</title>
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
    <h1>Buat Artikel Baru</h1>
    <form method="post" action="create.php">
        <div class="article">
            <h2><input type="text" name="title" placeholder="Judul Artikel"></h2>
            <p><textarea name="body" cols="30" rows="10" placeholder="Isi Artikel"></textarea></p>
            <p>
                Kategori: 
                <select name="category">
                    <option value="1">Nasional</option>
                    <option value="2">Internasional</option>
                    <option value="3">Ekonomi</option>
                    <option value="4">Teknologi</option>
                    <option value="5">Olahraga</option>
                    <option value="6">Hiburan</option>
                </select>
            </p>
            <p>Author ID: <input type="number" name="author_id" placeholder="ID Penulis"></p>
            <p>Image URL: <input type="text" name="image_url" placeholder="URL Gambar"></p>
            <p><input type="submit" name="create" value="Buat"></p>
        </div>
    </form>
</body>
</html>

