<?php
// Memanggil file koneksi.php
include_once("config.php");

$titleErr = $bodyErr = $categoryErr = $authorErr = $imageErr = "";
// Syntax untuk menambahkan data baru ke table articles
if (isset($_POST['create'])) {
    $title = trim($_POST['title']);
    $body = trim($_POST['body']);
    $category_id = $_POST['category'];
    $author_id = isset($_POST['author']) ? $_POST['author'] : '';
    $image_url = trim($_POST['image_url']);

    if (empty($title)) {
        $titleErr = "Title tidak boleh kosong";
    }
    if (empty($body)) {
        $bodyErr = "Isi artikel tidak boleh kosong";
    }
    if ($category_id == 0) {
        $categoryErr = "Kategori tidak boleh kosong";
    }
    if (empty($author_id)) {
        $authorErr = "Author tidak boleh kosong";
    }
    if (empty($image_url)) {
        $imageErr = "Image URL tidak boleh kosong";
    }
    if (!empty($titleErr) || !empty($bodyErr) || !empty($categoryErr) || !empty($authorErr) || !empty($imageErr)) {
        echo "<ul>";
        foreach ([$titleErr, $bodyErr, $categoryErr, $authorErr, $imageErr] as $error) {
            if (!empty($error)) {
                echo "<li>$error</li>";
            }
        }
        echo "</ul>";
    } else {
        $result = mysqli_query($con, "INSERT INTO articles (title, body, category_id, author_id, image_url) VALUES ('$title', '$body', '$category_id', '$author_id', '$image_url')");
        if ($result) {
            header("Location: index.php");
            exit();
        } else {
            echo "Gagal menambahkan data: " . mysqli_error($con);
        }
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
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <h1>Buat Artikel Baru</h1>
    <form method="post" action="create.php">
        <div class="article">
            <h2><input type="text" name="title" placeholder="Judul Artikel"></h2>
            <span class="error">* <?php echo $titleErr; ?></span>
            <p><textarea name="body" cols="30" rows="10" placeholder="Isi Artikel"></textarea></p>
            <span class="error">* <?php echo $bodyErr; ?></span>
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
            <span class="error">* <?php echo $categoryErr; ?></span>
            <p>Author ID: <input type="number" name="author_id" placeholder="ID Penulis"></p>
            <span class="error">* <?php echo $authorErr; ?></span>
            <p>Image URL: <input type="text" name="image_url" placeholder="URL Gambar"></p>
            <span class="error">* <?php echo $imageErr; ?></span>
            <p><input type="submit" name="create" value="Buat"></p>
        </div>
    </form>
</body>
</html>

