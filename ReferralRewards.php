<?php
?>

<!DOCTYPE html>
<html>
  <head>
    <title style="font-size: 30px" >Refer and Earn Program</title>
    <style>
      /* Styles for the header section */
      body{
        background-color: #161730;
        color: #fff;
      }
      header {
        background-color: #212244;
        color: #fff;
        text-align: center;
        padding: 20px;
        border-radius: 20px;
        margin-top: 20px;
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
        background-color: #212244;
        border-radius: 10px;
        color: #fff;
        
      }
      main button {
        background-color: #6B54EB;
        color: #fff;
        padding: 10px;
        border: none;
        border-radius: 4px;
        font-size: 18px;
        cursor: pointer;
      }
      main button:hover {
        background-color: #6B54EB;
      }

      /* Styles for the footer section */
      footer {
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
      <h1>Refer and Earn</h1>
    </header>
    <main>
      <p>Refer To your friends and earn rewards! Here's how it works:</p>
      <ul>
        <li>Share your referral code with your friends.</li>
        <!-- <li>Your friend signs up using your code.</li> -->
        <li>Rewards<br> • $ 0.10 Signup bonus <br> • $ 5.0 Server Upgrade bonu <br> • $ 5.5 First investment bonus</li>
      </ul>
      <p>Your referral code is:</p>
      <input type="text" value="<?php echo $_GET['referral_code']; ?>" readonly>
      <p>Copy and share this code with your friends to start earning rewards!</p>
      <button id="copy" onclick="copyTextToClipboard('<?php echo $_GET['referral_code'] ?>')">Copy</button>
    </main>
    <footer>
      <p>&copy; 2023 Example Company. All rights reserved.</p>
    </footer>
  </body>
</html>

<script>
    function fallbackCopyTextToClipboard(text) {
    var textArea = document.createElement("textarea");
    textArea.value = text;
    
    // Avoid scrolling to bottom
    textArea.style.top = "0";
    textArea.style.left = "0";
    textArea.style.position = "fixed";

    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();

    try {
        var successful = document.execCommand('copy');
        var msg = successful ? 'successful' : 'unsuccessful';
        console.log('Fallback: Copying text command was ' + msg);
    } catch (err) {
        console.error('Fallback: Oops, unable to copy', err);
    }

    document.body.removeChild(textArea);
    }
    function copyTextToClipboard(text) {
      Android.showToast("copied");
    if (!navigator.clipboard) {
        fallbackCopyTextToClipboard(text);
        return;
    }
    navigator.clipboard.writeText(text).then(function() {
        console.log('Async: Copying to clipboard was successful!');
    }, function(err) {
        console.error('Async: Could not copy text: ', err);
    });
    }

    
</script>