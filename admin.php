<?php
include 'db.php'; // Include database connection

// Handle file upload
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $filename = $_FILES['image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        
        // Get title and description from form and check if they're not empty
        $title = isset($_POST['title']) ? trim($_POST['title']) : null;
        $description = isset($_POST['description']) ? trim($_POST['description']) : null;

        // Check if title and description are not empty
        if (empty($title) || empty($description)) {
            $error_message = "Error: Title and description are required.";
        } else {
            // Verify file extension
            if (!in_array($ext, $allowed)) {
                $error_message = "Error: Please select a valid file format.";
            } else {
                // Move the file to "uploads" directory
                $uploadPath = "uploads/" . $filename;
                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
                    // Insert image details into the database
                    $stmt = $pdo->prepare("INSERT INTO images (image_name, image_path, title, description) 
                                           VALUES (:image_name, :image_path, :title, :description)");
                    $stmt->execute([
                        'image_name' => $filename,
                        'image_path' => $uploadPath,
                        'title' => $title,
                        'description' => $description
                    ]);

                    $success_message = "File uploaded successfully and saved to the database.";
                } else {
                    $error_message = "Error: Unable to upload the file.";
                }
            }
        }
    } else {
        $error_message = "Error: " . $_FILES['image']['error'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Upload Image</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Custom Styles -->
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #343a40;
        }
        .navbar a {
            color: #fff !important;
        }
        .container {
            margin-top: 50px;
        }
        .upload-form {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        .upload-form h2 {
            margin-bottom: 20px;
        }
        .alert {
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="#">Admin Panel</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Images</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <div class="upload-form">
            <h2>Upload Image</h2>

            <?php if (isset($success_message)): ?>
                <div class="alert alert-success">
                    <strong>Success!</strong> <?php echo $success_message; ?>
                </div>
            <?php endif; ?>

            <?php if (isset($error_message)): ?>
                <div class="alert alert-danger">
                    <strong>Error!</strong> <?php echo $error_message; ?>
                </div>
            <?php endif; ?>

            <form action="admin.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="image">Choose Image:</label>
                    <input type="file" name="image" id="image" class="form-control-file" required>
                </div>
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" name="title" id="title" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea name="description" id="description" class="form-control" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Upload</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS, Popper.js, jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
