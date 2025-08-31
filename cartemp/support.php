<?php
$submitted = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = new mysqli("localhost", "root", "", "car_rental");
    if ($conn->connect_error) {
        $error = "Database connection failed.";
    } else {
        $name = $conn->real_escape_string($_POST['name']);
        $email = $conn->real_escape_string($_POST['email']);
        $message = $conn->real_escape_string($_POST['message']);

        $sql = "INSERT INTO contact_messages (name, email, message) VALUES ('$name', '$email', '$message')";
        if ($conn->query($sql) === TRUE) {
            header("Location: individual_home.html");
            exit();
        } else {
            $error = "Failed to submit message.";
        }
        
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Contact Us - Car Rental</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    h2{
        color: black;
        
    }
    body {
      background-color: black;
      color: #c9d1d9;
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      flex-direction: column;
    }
    .section, .contact {
      background-color: white;
      padding: 2rem;
      border-radius: 10px;
      width: 90%;
      max-width: 800px;
      box-shadow: 0 0 10px #000;
      margin-bottom: 2rem;
      text-align: center;
    }
    .contact-form input, .contact-form textarea {
  background-color: white;
  border: 1px solid black; /* fixed border */
  padding: 0.8rem;
  color: black; /* changed input text color */
  border-radius: 5px;
   }

     .contact-info p {
      color: black; /* fixed text color */
      margin: 0.5rem 0;
      }

    h2 {
      margin-bottom: 1.5rem;
    }
    .why-us {
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    .why-us img {
      width: 250px;
      margin-bottom: 1rem;
    }
    .why-us ul {
      list-style: none;
      padding: 0;
    }
    .why-us li {
      margin: 0.5rem 0;
    }
    .why-us i {
      color: #238636;
      margin-right: 0.5rem;
    }
    .contact-form {
      display: flex;
      flex-direction: column;
      gap: 1rem;
      margin-bottom: 1.5rem;
    }
    
    .btn-primary {
      background-color: black;
      color: white;
      border: none;
      padding: 0.8rem;
      border-radius: 5px;
      cursor: pointer;
    }
    .btn-primary:hover {
      background-color: gray;
    }
   
    .contact-info i {
      margin-right: 0.5rem;
    }
    .message {
      margin-bottom: 1rem;
      color: #2ea043;
    }
    .error {
      margin-bottom: 1rem;
      color: #f85149;
    }
  </style>
</head>
<body>

 

  <section class="contact">
    <h2>Contact Us</h2>

    <?php if ($submitted): ?>
      <div class="message">Thank you! Your message has been submitted.</div>
    <?php elseif ($error): ?>
      <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <form class="contact-form" method="POST" action="">
      <input type="text" name="name" placeholder="Name" required />
      <input type="email" name="email" placeholder="Email Address" required />
      <textarea name="message" rows="4" placeholder="Message" required></textarea>
      <button class="btn-primary" type="submit">SUBMIT</button>
    </form>

    <div class="contact-info">
      <p><i class="fas fa-envelope"></i> karen.nader@jermain.co</p>
      <p><i class="fas fa-phone"></i> +352-11494232</p>
      <p><i class="fas fa-map-marker-alt"></i> 847 Casper Mews Apt. 066</p>
    </div>
  </section>

</body>
</html>
