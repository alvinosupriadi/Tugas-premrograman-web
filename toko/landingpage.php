<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Laptop</title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="landingpage.css">
</head>
<body>
    <header>
        <nav class="main-nav">
            <div class="logo">Toko Laptop</div>
           
            <ul class="nav">
                <?php
                session_start();
                    if (isset($_SESSION['username'])) {
                        echo '<li><a href="user/users/user_dashboard.php"><span class="username">' . $_SESSION['username'] . '</span></a></li>';
                        echo '<li><a href="user/logout.php">Log Out</a></li>';
                    } else {
                        echo '<li><a href="user/login.php">Log In</a></li>';
                    }
                ?>
                <li class="dropdown">
                    <a href="javascript:void(0)" class="dropbtn">MENU</a>
                    <div class="dropdown-content">
                        <ul>
                           
                           
                            <li ><a href="landingpage.php">Home</a></li>
                            <li><a href="produk.php">Produk</a></li>
                            <li><a href="kontak.php">Kontak</a></li>
                            <li><a href="about.html">About</a></li>
                            <li><a href="chatboot/chatbot.html">bantuan</a></li>
                        </ul> 
                    </div>
                </li>
            </ul>      
        </nav>
    </header>

    <section class="hero">
        <div class="hero-content">
            <h1>Toko Laptop Terbaik</h1>
            <p>Temukan Laptop Impian Anda di Sini</p>
            <a href="produk.php" class="cta-button">Lihat Selengkapnya</a>
        </div>
    </section>
</body>
</html>
