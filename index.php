<?php
include 'config.php';

$uploadDir = 'uploads/';
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Insert or Update
if (isset($_POST['save'])) {
    $id = $_POST['id'];
    $title = $_POST['book_title'];
    $author = $_POST['author_name'];
    $genre = $_POST['genre'];
    $year = $_POST['publication_year'];
    $quantity = $_POST['quantity'];

    $coverPath = null;

    // Handle image upload
    if (isset($_FILES['book_cover']) && $_FILES['book_cover']['error'] === UPLOAD_ERR_OK) {
        $filename = basename($_FILES['book_cover']['name']);
        $targetPath = $uploadDir . time() . "_" . $filename;

        if (move_uploaded_file($_FILES['book_cover']['tmp_name'], $targetPath)) {
            $coverPath = $targetPath;
        }
    }

    if ($id) {
        // UPDATE
        $query = "UPDATE library SET 
            book_title='$title', 
            author_name='$author', 
            genre='$genre', 
            publication_year=$year, 
            quantity=$quantity";

        if ($coverPath) {
            $query .= ", book_cover='$coverPath'";
        }

        $query .= " WHERE id=$id";
        $conn->query($query);
    } else {
        // INSERT
        $query = "INSERT INTO library (book_title, author_name, book_cover, genre, publication_year, quantity) 
                  VALUES ('$title', '$author', '$coverPath', '$genre', $year, $quantity)";
        $conn->query($query);
    }

    header("Location: index.php");
    exit();
}

// Fetch all books
$result = $conn->query("SELECT * FROM library");

// Get book for edit
$editData = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $editData = $conn->query("SELECT * FROM library WHERE id=$id")->fetch_assoc();
}

// View a book
if (isset($_GET['view'])) {
    $viewId = intval($_GET['view']);
    $viewBook = $conn->query("SELECT * FROM library WHERE id=$viewId")->fetch_assoc();
    include 'views/library.php';
    exit();
}

// Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM library WHERE id=$id");
    header("Location: index.php");
    exit();
}

include 'views/header.php';
include 'views/form.php';
include 'views/library_table.php';
?>
