<?php
include 'db.php';

$sql = "SELECT title, video_path FROM videos ORDER BY uploaded_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <title>Video Gallery</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #74ebd5, #acb6e5);
            color: #333;
        }
        h2 {
            color: #2c3e50;
            margin-top: 20px;
            font-size: 2rem;
            text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.1);
        }
        .gallery-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            padding: 20px;
            max-width: 1200px;
            margin: 20px auto;
        }
        .video-card {
            background: #ffffff;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .video-card:hover {
            transform: scale(1.05); /* Slight zoom on hover */
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3); /* Stronger shadow on hover */
        }
        .video-card video {
            width: 100%;
            height: auto;
            border-radius: 8px; /* Rounded corners for the video */
        }
        .video-card h3 {
            margin-top: 10px;
            font-size: 1.2rem;
            color: #2c3e50;
            font-weight: bold;
        }
        p {
            font-size: 1.2rem;
            color: #555;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <h2>Uploaded Videos</h2>
    <div class="gallery-container">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='video-card'>";
                echo "<video controls>
                        <source src='" . htmlspecialchars($row['video_path']) . "' type='video/mp4'>
                      </video>";
                echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
                echo "</div>";
            }
        } else {
            echo "<p>No videos uploaded yet.</p>";
        }
        ?>
    </div>

</body>
</html>

<?php $conn->close(); ?>