<?php

if(isset($_GET['referral_code'])){
    echo $_GET['referral_code'];
}

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Refer and Earn Program</title>
    <style>
      /* Styles for the header section */
      header {
        background-color: #333;
        color: #fff;
        text-align: center;
        padding: 20px;
      }
      header h1 {
        margin: 0;
        font-size: 40px;
      }

      /* Styles for the main section */
      main {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
      }
      main p {
        font-size: 18px;
        line-height: 1.5;
      }
      main ul {
        margin: 0;
        padding: 0;
        list-style: none;
      }
      main li {
        font-size: 18px;
        line-height: 1.5;
        margin-bottom: 10px;
      }
      main input[type="text"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        font-size: 18px;
        border: 1px solid #ccc;
      }
      main button {
        background-color: #333;
        color: #fff;
        padding: 10px;
        border: none;
        border-radius: 4px;
        font-size: 18px;
        cursor: pointer;
      }
      main button:hover {
        background-color: #555;
      }

      /* Styles for the footer section */
      footer {
        background-color: #333;
        color: #fff;
        text-align: center;
        padding: 10px;
      }
      footer p {
        margin: 0;
        font-size: 14px;
      }
    </style>
  </head>
  <body>
    <header>
      <h1>Refer and Earn Program</h1>
    </header>
    <main>
      <p>Refer your friends to our service and earn rewards! Here's how it works:</p>
      <ul>
        <li>Share your unique referral link with your friends.</li>
        <li>Your friend signs up for our service using your link.</li>
        <li>You both receive rewards!</li>
      </ul>
      <p>Your unique referral link is:</p>
      <input type="text" value="https://www.example.com/refer/your-unique-id" readonly>
      <p>Copy and share this link with your friends to start earning rewards!</p>
      <button>Copy Link</button>
    </main>
    <footer>
      <p>&copy; 2023 Example Company. All rights reserved.</p>
    </footer>
  </body>
</html>
