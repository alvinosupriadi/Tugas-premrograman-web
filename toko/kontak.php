<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak - Toko Laptop</title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/gabungan.css">
</head>
<body>
    <header>
        <nav class="main-nav">
        <div class="logo">Toko Laptop</div>
           
           <ul class="nav">
               <?php
               session_start();
                   if (isset($_SESSION['username'])) {
                       echo '<li><a href="user/users/user_dashboard.php"><span class="username">HI..' . $_SESSION['username'] . '</span></a></li>';
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
                            <li><a href="about.php">About</a></li>
                            <li><a href="chatboot/chatbot.html">bantuan</a></li>
                       </ul> 
                   </div>
               </li>
           </ul>      
       </nav>
    </header>
    <main>
        <h2>Kontak Kami</h2>
        <form action="kontak_submit.php" method="post">
            <label for="name">Nama:</label>
            <input type="text" id="name" name="name" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="message">Pesan:</label>
            <textarea id="message" name="message" required></textarea>
            <button type="submit">Kirim</button>
        </form>
    </main>
    <footer>
        <p>&copy; 2024 Toko Laptop</p>
    </footer>
</body>
</html>
