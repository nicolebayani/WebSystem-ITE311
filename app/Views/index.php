<?php

helper('url');


$path = trim(service('uri')->getPath(), '/');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LEARNIFY</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            background: linear-gradient(135deg, #a72c2c, #e0b4b4);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .welcome-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.3);
            color: #fff;
            text-align: center;
            max-width: 600px;
            margin: auto;
        }
        .welcome-card h1 {
            font-weight: bold;
            text-shadow: 0 2px 5px rgba(0,0,0,0.4);
        }
    </style>
</head>
<body>

<?= $this->include('partials/navbar') ?>


<div class="container d-flex align-items-center justify-content-center flex-grow-1 py-5">
    <div class="welcome-card">
        <h1>Welcome to LEARNIFY</h1>
    </div>
</div>

</body>
</html>
