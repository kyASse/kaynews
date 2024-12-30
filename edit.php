<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

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

$titleErr = $bodyErr = $categoryErr = $authorErr = $imageErr = '';

// Syntax untuk mengupdate data pada table articles
if (isset($_POST['update'])) {
    $title = $_POST['title'];
    $body = $_POST['body'];
    $category_id = $_POST['category_id'];
    $author_id = $_POST['author'];
    $image_url = $_POST['image_url'] ? $_POST['image_url'] : $article['image_url'];

    if (empty($title)) {
        $titleErr = "Title tidak boleh kosong";
    }
    if (empty($body)) {
        $bodyErr = "Isi artikel tidak boleh kosong";
    }
    if (empty($category_id)) {
        $categoryErr = "Kategori tidak boleh kosong";
    }
    if (empty($author_id)) {
        $authorErr = "Author tidak boleh kosong";
    }
    if (empty($image_url)) {
        $imageErr = "Image URL tidak boleh kosong";
    }
    if (empty($titleErr) && empty($bodyErr) && empty($categoryErr) && empty($authorErr) && empty($imageErr)) {
        $result = mysqli_query($con, "UPDATE articles SET title='$title', body='$body', category_id='$category_id', author_id='$author_id', image_url='$image_url' WHERE id='$id'");
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
    <title>Edit Artikel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8fafc;
        }
        .article {
            border-radius: 1rem;
            padding: 1rem;
            margin-bottom: 1rem;
            background-color: white;
            box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
        }
        .article h2 {
            margin: 0;
            font-size: 1.5em;
        }
        .article p {
            margin-bottom: 1rem;
        }
        .article img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 1rem;
            margin-bottom: 1rem;
        }
        .article a {
            text-decoration: none;
            color: #007BFF;
        }
        .article a:hover {
            text-decoration: underline;
        }
        .error{
            color: red;
        }
    </style>
</head>
<body>
    <header class="bg-light py-4">
        <div class="container">
            <?php include_once('header.php'); ?>
        </div>
    </header>
    <div class="container mt-3">
        <h1 class="text-center">Edit Artikel</h1>
        <form method="post" action="">
            <div class="article">
                <h2><input type="text" name="title" value="<?php echo htmlspecialchars($article['title']); ?>" class="form-control"></h2>
                <span class="error"><?php echo $titleErr; ?></span>
                <img src="<?php echo htmlspecialchars($article['image_url']); ?>" alt="<?php echo htmlspecialchars($article['title']); ?>" class="rounded">
                <p><textarea name="body" cols="30" rows="10" class="form-control"><?php echo htmlspecialchars($article['body']); ?></textarea></p>
                <span class="error"><?php echo $bodyErr; ?></span>
                <p>
                    Kategori: 
                    <select name="category_id" class="form-control">
                        <?php $selectedCategory = $article['category_id'] ?? ''; ?>
                        <option value="1" <?php echo $selectedCategory == 1 ? 'selected' : ''; ?>>Nasional</option>
                        <option value="2" <?php echo $selectedCategory == 2 ? 'selected' : ''; ?>>Internasional</option>
                        <option value="3" <?php echo $selectedCategory == 3 ? 'selected' : ''; ?>>Ekonomi</option>
                        <option value="4" <?php echo $selectedCategory == 4 ? 'selected' : ''; ?>>Teknologi</option>
                        <option value="5" <?php echo $selectedCategory == 5 ? 'selected' : ''; ?>>Olahraga</option>
                        <option value="6" <?php echo $selectedCategory == 6 ? 'selected' : ''; ?>>Hiburan</option>
                    </select>
                    <span class="error"><?php echo $categoryErr; ?></span>
                </p>
                <p>Author ID: <input type="number" name="author" value="<?php echo htmlspecialchars($article['author_id']); ?>" class="form-control"></p>
                <span class="error"><?php echo $authorErr; ?></span>
                <p>Image URL: <input type="text" name="image_url" value="<?php echo htmlspecialchars($article['image_url']); ?>" class="form-control"></p>
                <span class="error"><?php echo $imageErr; ?></span>
                <p><input type="submit" name="update" value="Update" class="btn btn-primary"></p>
            </div>
        </form>
    </div>
</body>
</html>

