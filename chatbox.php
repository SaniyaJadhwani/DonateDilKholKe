<?php
session_start();
$sender = $_SESSION['username']; // Assume this is logged-in user
$receiver = $_GET['with']; // The person they are chatting with

$con = new mysqli("localhost", "Saniya", "", "donate_dilkholke");
if ($con->connect_error) die("Connection Failed");

?>
<!DOCTYPE html>
<html>
<head>
  <title>Chat with <?php echo $receiver; ?></title>
  <style>
    body {
      font-family: Poppins, sans-serif;
      background: #fff0f0;
    }
    .chatbox {
      max-width: 600px;
      margin: 30px auto;
      border: 2px solid #800000;
      border-radius: 8px;
      padding: 15px;
      background: white;
    }
    .messages {
      height: 300px;
      overflow-y: scroll;
      border: 1px solid #ccc;
      padding: 10px;
      margin-bottom: 10px;
    }
    .message {
      margin: 5px 0;
    }
    .message.you {
      text-align: right;
      color: #800000;
    }
    form textarea {
      width: 100%;
      height: 60px;
      border: 1px solid #ccc;
      padding: 10px;
      resize: none;
    }
    .btn {
      margin-top: 5px;
      padding: 10px 20px;
      background: #800000;
      color: white;
      border: none;
      cursor: pointer;
      float: right;
    }
  </style>
</head>
<body>

<div class="chatbox">
  <h2>Chat with <?php echo $receiver; ?></h2>
  <div class="messages" id="chat">
    <!-- Chat messages will load here -->
  </div>
  <form id="chatForm">
    <textarea name="message" placeholder="Type your message..." required></textarea>
    <input type="hidden" name="sender" value="<?php echo $sender; ?>">
    <input type="hidden" name="receiver" value="<?php echo $receiver; ?>">
    <button type="submit" class="btn">Send</button>
  </form>
</div>

<script>
function fetchMessages() {
  const xhr = new XMLHttpRequest();
  xhr.onload = function () {
    document.getElementById("chat").innerHTML = this.responseText;
  }
  xhr.open("GET", "fetch_messages.php?sender=<?php echo $sender; ?>&receiver=<?php echo $receiver; ?>", true);
  xhr.send();
}

document.getElementById("chatForm").onsubmit = function(e) {
  e.preventDefault();
  const formData = new FormData(this);
  fetch("send_message.php", {
    method: "POST",
    body: formData
  }).then(() => {
    fetchMessages();
    this.reset();
  });
};

setInterval(fetchMessages, 2000); // Auto-refresh chat every 2 seconds
fetchMessages(); // Initial load
</script>

</body>
</html>
