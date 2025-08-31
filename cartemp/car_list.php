<?php
$conn = new mysqli("localhost", "root", "", "car_rental");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM cars";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Car Listings</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: #fff;
      color: #000;
    }

    .topbar {
      display: flex;
      gap: 10px;
      padding: 15px;
      background: #f5f5f5;
      justify-content: center;
      align-items: center;
    }

    .topbar input, .topbar select {
      padding: 10px;
      border-radius: 5px;
      border: 1px solid #ccc;
      background: #fff;
      color: #000;
    }

    .topbar button {
      padding: 10px 20px;
      background: #000;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .container {
      display: flex;
      padding: 20px;
    }

    .filters {
      width: 250px;
      background: #f0f0f0;
      padding: 20px;
      border-radius: 10px;
      margin-right: 20px;
    }

    .filters h3 {
      border-bottom: 1px solid #ccc;
      padding-bottom: 5px;
      color: #000;
    }

    .filters label {
      display: block;
      margin: 8px 0;
      color: #000;
    }

    .car-listings {
      flex: 1;
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
      gap: 20px;
    }

    .car-card {
      background: #fff;
      border-radius: 10px;
      border: 1px solid #ddd;
      overflow: hidden;
      transition: transform 0.3s;
    }

    .car-card:hover {
      transform: scale(1.01);
    }

    .car-card img {
      width: 100%;
      height: 180px;
      object-fit: cover;
    }

    .car-info {
      padding: 15px;
    }

    .car-info h4 {
      margin: 0;
      color: #000;
    }

    .car-info p {
      font-size: 14px;
      margin: 5px 0;
      color: #555;
    }

    .car-footer {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0 15px 15px;
    }

    .price {
      font-size: 18px;
      color: #000;
      font-weight: bold;
    }

    .old-price {
      text-decoration: line-through;
      color: #aaa;
      font-size: 14px;
    }

    .book-btn {
      padding: 8px 15px;
      background: #000;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .rating {
      font-size: 14px;
      color: #000;
    }
  </style>
</head>
<body>

<div class="topbar">
  <!-- Location Removed -->
  <input type="date">
  <select>
    <option>12:00 am</option>
  </select>
  <input type="date">
  <select>
    <option>12:00 am</option>
  </select>
  <button>Search</button>
</div>

<div class="container">
  <div class="filters">
    <h3>Car Type</h3>
    <label><input type="checkbox"> Economy</label>
    <label><input type="checkbox"> Compact</label>
    <label><input type="checkbox"> Midsize</label>
    <label><input type="checkbox"> SUV</label>

    <h3>Passengers</h3>
    <label><input type="checkbox"> 1 to 2</label>
    <label><input type="checkbox"> 3 to 5</label>
    <label><input type="checkbox"> 6 or more</label>

    <h3>Bags</h3>
    <label><input type="checkbox"> 1 to 2</label>
    <label><input type="checkbox"> 3 to 4</label>
    <label><input type="checkbox"> 5 or more</label>

    <h3>Transmission</h3>
    <label><input type="checkbox"> Automatic</label>
    <label><input type="checkbox"> Manual</label>

    <h3>User Review</h3>
    <label><input type="checkbox"> Excellent</label>
    <label><input type="checkbox"> Good</label>
    <label><input type="checkbox"> Fair</label>
  </div>

  <div class="car-listings">
    <?php while($car = $result->fetch_assoc()): ?>
      <div class="car-card">
        <img src="<?= htmlspecialchars($car['image_url']) ?>" alt="<?= htmlspecialchars($car['name']) ?>">
        <div class="car-info">
          <h4><?= htmlspecialchars($car['name']) ?></h4>
          <p><?= htmlspecialchars($car['type']) ?> | <?= $car['transmission'] ?> | <?= $car['passengers'] ?> Passengers | <?= $car['bags'] ?> Bags</p>
          <p class="rating">⭐ <?= isset($car['review_score']) ? $car['review_score'] : "N/A" ?> (<?= isset($car['review_count']) ? $car['review_count'] : "0" ?> reviews)</p>
        </div>
        <div class="car-footer">
          <div>
            <div class="price">$<?= $car['price'] ?></div>
            <?php if (isset($car['old_price']) && $car['old_price'] > 0): ?>
              <div class="old-price">$<?= $car['old_price'] ?></div>
            <?php endif; ?>
          </div>
          <button class="book-btn">Book</button>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
</div>

</body>
</html>
