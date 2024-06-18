<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "toko_laptop"; 

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $brand = $_POST["brand"];
    $name = $_POST["name"];
    $price = $_POST["price"];
    $image = $_POST["image"];
    $spek = $_POST["spek"];

    $sql = "INSERT INTO products (brand, name, price, image, spek) VALUES ('$brand', '$name', '$price', '$image', '$spek')";

    if ($conn->query($sql) === TRUE) {
        echo "New product added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();

    header("Location: manage_product.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        
        .header {
            background-color: #2c3e50;
            color: #fff;
            padding: 10px 20px; 
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between; 
            align-items: center;
            position: relative;
            z-index: 999; 
        }

        .logo {
            font-size: 1.5em;
            font-weight: bold;
            color: #fff;
            text-decoration: none;
        }

        .content {
            padding: 20px;
            flex: 1; 
            transition: margin-left 0.3s ease;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .widget {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            flex-basis: 100%;
            box-sizing: border-box;
        }

        .widget h2 {
            margin-top: 0;
            font-size: 1.5rem;
            color: #333;
        }

        .widget p {
            color: #666;
        }

        
        form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        form input[type="text"],
        form input[type="number"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            color: #fff;
            cursor: pointer;
            background-color: #2ecc71;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #27ae60;
        }

        .footer {
            background-color: #2c3e50;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1);
            position: relative;
            width: 100%;
            margin-top: auto;
        }
    </style>
</head>
<body>
    <div class="header">
        <a href="#" class="logo">Add New Product</a>
    </div>

    <div class="content">
        <div class="widget">
            <h2>Add New Product</h2>
            <form action="add_product.php" method="post">
                <label for="brand">Brand:</label>
                <input type="text" id="brand" name="brand" required><br><br>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required><br><br>
                <label for="price">Price:</label>
                <input type="number" step="0.01" id="price" name="price" required><br><br>
                <label for="image">Image URL:</label>
                <input type="text" id="image" name="image" required><br><br>
                <label for="spek">Specifications:</label>
                <input type="text" id="spek" name="spek" required><br><br>
                <button type="submit" class="btn">Add Product</button>
            </form>
        </div>
    </div>

    <div class="footer">
        <p>Add Product Page - &copy; 2024</p>
    </div>
</body>
</html>
