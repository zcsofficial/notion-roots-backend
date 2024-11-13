<?php
include 'db.php'; // Include database connection

// Fetch project data (images, titles, descriptions) from the database
// Ordering by 'id' or any existing column like 'name' or 'title' (you can adjust this based on your table structure)
$stmt = $pdo->query("SELECT * FROM images ORDER BY id DESC");
$projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects - Notion ROOTS</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="proje.css">
    <style>
        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Century Gothic', sans-serif;
        }

        body {
            font-family: 'Century Gothic', sans-serif;
        }

        .navbar {
            background-color: transparent;
        }

        .projects {
            position: relative;
            background-image: url('https://res.cloudinary.com/dhuaf8e9z/image/upload/v1730908317/zfyxi1l9kacxw5gqytul.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: #fff;
            height: 100vh; /* Ensure the project section fills the screen height */
            display: flex;
            align-items: center;
        }

        .projects .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }

        .projects .container {
            position: relative;
            z-index: 2;
        }

        .project-info {
            position: absolute;
            bottom: 0;
            width: 100%;
            padding: 15px;
            background-color: rgba(0, 0, 0, 0.7);
            color: #fff;
            text-align: center;
        }

        .project-info h5 {
            font-weight: 700;
            margin: 0;
            font-size: 1.2rem;
        }

        .project-info p {
            font-size: 0.9rem;
            margin: 5px 0 0;
        }

        .navbar .navbar-nav .nav-link {
            color: white;
            font-size: 1.1rem;
            font-weight: 400;
            text-transform: uppercase;
            padding: 10px 15px;
        }

        .navbar .navbar-nav .nav-link:hover {
            color: #aaa86b;
            text-decoration: none;
        }

        .navbar .navbar-nav .nav-item.active .nav-link {
            color: #aaa86b;
            font-weight: bold;
        }

        .navbar.scrolled {
            background-color: #454343;
            transition: background-color 1s;
        }

        .project-card img {
            height: 250px;
            object-fit: cover;
            border-radius: 8px;
        }

        .project-card {
            position: relative;
            overflow: hidden;
            border-radius: 8px;
            transition: transform 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .project-card:hover img {
            transform: scale(1.1);
            transition: transform 0.3s ease-in-out;
        }

        .project-info {
            background: linear-gradient(to top, rgba(0.8, 0.8, 1, 1), rgba(0, 0, 0, 0));
        }

        /* Fade-in & fade-out */
        body {
            opacity: 0;
            transform: translateY(1px);
            transition: opacity 2s ease-in-out, transform 2s ease-in-out;
        }

        .fade-in {
            opacity: 1;
            transform: translateY(0);
        }

        .fade-out {
            opacity: 0;
            transform: translateY(1px);
        }

        /* Make sure the content fills the screen */
        .projects .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        @media (max-width: 768px) {
            .project-info h5 {
                font-size: 1rem;
            }

            .project-info p {
                font-size: 0.85rem;
            }

            .navbar .navbar-nav .nav-link {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <div class="white-fade-overlay"></div>

    <!-- Navbar -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top">
            <a class="navbar-brand" href="index.html">
                <img src="https://res.cloudinary.com/dhuaf8e9z/image/upload/v1730992852/vcmtxi5ht6gsxh4hoiv3.png" height="50" width="100%" alt="Notion Roots Logo"/>
            </a>
            <button class="navbar-toggler bg-light" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="AboutUs.html">About Us</a></li>
                    <li class="nav-item active"><a class="nav-link" href="index.php">Projects</a></li>
                    <li class="nav-item"><a class="nav-link" href="awards.html">Awards</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact-us.html">Contact</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Projects Section -->
    <section class="projects py-5">
        <div class="overlay"></div>
        <div class="container">
            <h2 class="text-center mb-5" style="font-size: 1.5rem;">PROJECTS</h2>
            <div class="row">
                <?php
                // Loop through the fetched project data and display each project
                foreach ($projects as $project) {
                    echo '
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="project-card shadow">
                            <img src="' . $project['image_path'] . '" class="img-fluid" alt="' . htmlspecialchars($project['title']) . '">
                            <div class="project-info">
                                <h5>' . htmlspecialchars($project['title']) . '</h5>
                                <p>' . htmlspecialchars($project['description']) . '</p>
                            </div>
                        </div>
                    </div>';
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(window).scroll(function() {
            if ($(window).scrollTop() > 50) {
                $('.navbar').addClass('scrolled');
            } else {
                $('.navbar').removeClass('scrolled');
            }
        });

        window.addEventListener('load', function () {
            document.body.classList.remove('fade-out');
            document.body.classList.add('fade-in');
        });
    </script>
</body>
</html>
