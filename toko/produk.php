<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk - Toko Laptop</title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/style.css">
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
                       </ul> 
                   </div>
               </li>
           </ul>      
       </nav>
    </header>
    <main>
        <h2>Daftar Produk</h2>
        <div id="product-list">
  <?php
  $host = 'localhost';
  $db = 'toko_laptop';
  $user = 'root';
  $pass = '';

  $conn = new mysqli($host, $user, $pass, $db);

  if ($conn->connect_error) {
    die("Koneksi gagal: ". $conn->connect_error);
  }

  $sql = "SELECT * FROM products";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $brands = array();
    while($row = $result->fetch_assoc()) {
      $brand = $row['brand'];
      if (!isset($brands[$brand])) {
        $brands[$brand] = array();
      }
      $brands[$brand][] = $row;
    }

    foreach ($brands as $brand => $products) {
      echo '<div class="brand-container">';
      echo '<h2 class="brand-title">'. $brand .'</h2>';
      echo '<div class="brand-products">';
      foreach ($products as $product) {
        echo '<div class="card">';
        echo '<img src="'. $product['image']. '" alt="'. $product['name']. '" class="card-img">';
        echo '<div class="card-body">';
        echo '<h3>'. $product['name']. '</h3>';
        echo '<h4>'. $product['spek']. '</h4>';
        echo '<div class="price-container">';
        echo '<p>Rp '. number_format($product['price'], 0, ',', '.'). '</p>';
        echo '</div>';
        echo '<div class="button-container">';
        echo '<a href="beli.php?id='. $product['id']. '" class="btn btn-primary">Beli Sekarang</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
      }
      echo '</div>';
      echo '</div>';
    }
  } else {
    echo '<p>Tidak ada produk ditemukan.</p>';
  }

  $conn->close();
?>
</div>
    </main>
    <footer>
        <p>&copy; 2024 Toko Laptop</p>
    </footer>
</body>
</html>
