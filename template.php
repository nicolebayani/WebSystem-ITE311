
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nics's WebSoL - Navbar</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  
  <style>
    
    body::before {
      content: "";
      position: fixed;
      inset: 0;
      z-index: -2;
      background: linear-gradient(120deg, #800000 0%, #dcdcdc 100%);
      opacity: 0.85;
      animation: gradientMove 10s ease-in-out infinite alternate;
    }
    @keyframes gradientMove {
      0% { background-position: 0% 50%; }
      100% { background-position: 100% 50%; }
    }

  
    .hero {
      position: relative;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 1;
      overflow: hidden;
    }
    .hero::before {
      content: "";
      position: absolute;
      inset: 0;
      background: url('https://images.unsplash.com/photo-1522206024047-9c925421675d?auto=format&fit=crop&w=1920&q=80') no-repeat center center/cover;
      filter: blur(4px) brightness(0.7);
      z-index: -1;
    }
    .glass-card {
      background: rgba(255,255,255,0.15);
      border-radius: 1.5rem;
      box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.18);
      backdrop-filter: blur(8px);
      -webkit-backdrop-filter: blur(8px);
      border: 1px solid rgba(255,255,255,0.25);
      padding: 3rem 4rem;
      text-align: center;
      color: #fff;
      max-width: 600px;
      margin: 0 auto;
    }
    .glass-card h1 {
      font-size: 2.8rem;
      font-weight: 700;
      letter-spacing: 1px;
      margin-bottom: 0.5rem;
      color: #fff;
      text-shadow: 0 2px 16px rgba(0,0,0,0.4);
    }
    .glass-card p {
      font-size: 1.25rem;
      color: #f5f5f5;
      margin-bottom: 0;
    }

   
    .navbar {
      background: rgba(128,0,0,0.92);
      border-bottom: 1.5px solid #fff2;
      box-shadow: 0 2px 12px 0 rgba(128,0,0,0.08);
      backdrop-filter: blur(6px);
    }
    .navbar .navbar-brand {
      color: #fff !important;
      font-weight: bold;
      font-size: 1.4rem;
      letter-spacing: 1px;
      text-shadow: 0 1px 8px #80000044;
    }
    .navbar .nav-link {
      color: #f5f5f5 !important;
      font-weight: 500;
      transition: color 0.3s;
      border-radius: 0.5rem;
      padding: 0.5rem 1rem;
    }
    .navbar .nav-link.active, .navbar .nav-link:hover {
      color: #fff !important;
      background: rgba(255,255,255,0.08);
    }
    .dropdown-menu {
      background: rgba(255,255,255,0.97);
      border: none;
      box-shadow: 0 6px 24px rgba(128,0,0,0.08);
      border-radius: 1rem;
      margin-top: 0.5rem;
    }
    .dropdown-item {
      color: #800000 !important;
      font-weight: 500;
      border-radius: 0.5rem;
      transition: background 0.2s;
    }
    .dropdown-item:hover {
      background: #f5eaea;
      color: #800000 !important;
    }
    .navbar .dropdown-toggle::after {
      display: none;
    }
    .navbar .dropdown-toggle i {
      margin-left: 5px;
      transition: transform 0.2s;
    }
    .navbar .dropdown.show .dropdown-toggle i.fa-plus {
      display: none;
    }
    .navbar .dropdown.show .dropdown-toggle i.fa-minus {
      display: inline;
    }
    .navbar .dropdown-toggle i.fa-minus {
      display: none;
    }
    
    @media (max-width: 600px) {
      .glass-card {
        padding: 2rem 1rem;
      }
      .glass-card h1 {
        font-size: 2rem;
      }
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg shadow-sm fixed-top">
  <div class="container">
    <a class="navbar-brand" href="#">Nics's WebSol</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link active" href="#">Home</a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
            Services <i class="fa-solid fa-plus"></i><i class="fa-solid fa-minus"></i>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Web Design</a></li>
            <li><a class="dropdown-item" href="#">Development</a></li>
            <li><a class="dropdown-item" href="#">SEO</a></li>
          </ul>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
      </ul>
    </div>
  </div>
</nav>


<section class="hero">
  <div class="glass-card">
    <h1>Welcome to Nics's WebSol</h1>
    <p>Modern web solutions with style and substance.</p>
  </div>
</section>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>