


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - Toko Laptop</title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/gabungan.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
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
                               <li><a href="landingpage.php">Home</a></li>
                               <li><a href="produk.php">Produk</a></li>
                               <li><a href="kontak.php">Kontak</a></li>
                               <li><a href="about.php">About</a></li>
                           </ul> 
                       </div>
                   </li>
               </ul>      
           </nav>
    </header>
    <main>
        <h2>Tentang Kami</h2>
        <p>Kami adalah toko laptop terpercaya yang menyediakan berbagai jenis laptop untuk kebutuhan Anda. Kami berkomitmen untuk memberikan produk berkualitas tinggi dan layanan pelanggan yang luar biasa.</p>
        <div class="additional-content">
            <h3>Kenapa Memilih Kami?</h3>
            <ul>
                <li>Produk berkualitas tinggi dari merek-merek ternama.</li>
                <li>Harga bersaing dan penawaran menarik.</li>
                <li>Layanan pelanggan yang ramah dan responsif.</li>
                <li>Garansi resmi dan dukungan purna jual.</li>
                <li>Pengiriman cepat dan aman.</li>
            </ul>
        </div>
        <div class="store-description">
            <h3>Deskripsi Toko</h3>
            <p>Toko Laptop kami telah beroperasi selama lebih dari 10 tahun, menyediakan berbagai jenis laptop untuk kebutuhan pribadi dan bisnis. Kami bekerja sama dengan merek-merek ternama untuk memastikan produk yang kami tawarkan adalah yang terbaik di pasaran. Selain itu, kami juga menyediakan layanan purna jual yang handal untuk memastikan kepuasan pelanggan.</p>
        </div>
        <div class="contact-info">
            <h3>Kontak Kami</h3>
            <ul>
                <li>WhatsApp: <a href="https://wa.me/1234567890" target="_blank">123-456-7890</a></li>
                <li>Instagram: <a href="https://instagram.com/tokolaptop" target="_blank">@tokolaptop</a></li>
                <li>Twitter: <a href="https://twitter.com/tokolaptop" target="_blank">@tokolaptop</a></li>
            </ul>
        </div>
        <div class="map">
            <h3>Lokasi Kami</h3>
            <P>alamat : jalan megamendung no 03 sukun,malang</P>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3162.917926917927!2d-122.084249684692!3d37.42199997982592!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808fb5e0b1b1b1b1%3A0x1b1b1b1b1b1b1b1b!2sGoogleplex!5e0!3m2!1sen!2sus!4v1633024800000!5m2!1sen!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </main>
    <footer>
        <p>&copy;Toko Laptop</p>
    </footer>
</body>
</html>