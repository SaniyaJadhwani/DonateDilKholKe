<?php
session_start();
<<<<<<< HEAD
$sender = $_SESSION['username']; // Assume this is logged-in user
$receiver = $_GET['with']; // The person they are chatting with

$con = new mysqli("localhost", "root", "", "donate_dilkholke");
if ($con->connect_error) die("Connection Failed");
=======
$con = new mysqli("localhost", "Saniya", "", "donate_dilkholke");
if ($con->connect_error) die("Connection failed: " . $con->connect_error);
>>>>>>> f835a6d7a2eda5ab53741bfcddba2b15fe245083

$current_user = $_SESSION['username'] ?? '';
$chat_with = $_GET['with'] ?? '';

if (!$current_user || !$chat_with) {
    echo "<p style='color:red; text-align:center;'>Invalid access. Chat not available.</p>";
    exit();
}

$check = $con->query("
  SELECT * FROM request 
  WHERE ((DonorName = '$current_user' AND RecieverName = '$chat_with') OR 
         (DonorName = '$chat_with' AND RecieverName = '$current_user'))
        AND Status = 'Accepted'
");

if ($check->num_rows === 0) {
    echo "<p style='color:red; text-align:center;'>Chat is only available after the request is accepted.</p>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Chat with <?php echo htmlspecialchars($chat_with); ?></title>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: #fff5f5;
      margin: 0;
      padding: 0;
    }

    .chat-wrapper {
      display: flex;
      justify-content: center;
      align-items: center;
      height: calc(100vh - 70px); /* Adjust if header height changes */
    }

    .chatbox {
      width: 400px;
      background: white;
      border: 2px solid #800000;
      border-radius: 10px;
      display: flex;
      flex-direction: column;
      overflow: hidden;
      height: 500px;
    }

    .chat-header {
      background: #800000;
      color: white;
      padding: 15px;
      font-weight: bold;
      text-align: center;
    }

    .chat-messages {
      flex: 1;
      padding: 15px;
      overflow-y: auto;
    }

    .message {
      margin-bottom: 10px;
      max-width: 75%;
      padding: 10px;
      border-radius: 10px;
      clear: both;
    }

    .sent {
      background: #800000;
      color: white;
      margin-left: auto;
      border-bottom-right-radius: 0;
    }

    .received {
      background: #eee;
      color: #333;
      margin-right: auto;
      border-bottom-left-radius: 0;
    }

    .chat-input {
      display: flex;
      border-top: 1px solid #ccc;
    }

    .chat-input input {
      flex: 1;
      padding: 12px;
      border: none;
      outline: none;
    }

    .chat-input button {
      padding: 0 20px;
      background: #800000;
      color: white;
      border: none;
      cursor: pointer;
    }
  </style>
</head>
<body>

<?php include 'header.php'; ?>

<div class="chat-wrapper">
  <div class="chatbox">
    <div class="chat-header">
      Chat with <?php echo htmlspecialchars($chat_with); ?>
    </div>
    <div class="chat-messages" id="messages"></div>
    <div class="chat-input">
      <input type="text" id="msgInput" placeholder="Type a message...">
      <button onclick="sendMessage()"><i class='bx bx-send'></i></button>
    </div>
  </div>
</div>

<script>
  const currentUser = "<?php echo $current_user; ?>";
  const chatWith = "<?php echo $chat_with; ?>";

  function loadMessages() {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "load_messages.php?with=" + chatWith, true);
    xhr.onload = function () {
      if (this.status === 200) {
        document.getElementById("messages").innerHTML = this.responseText;
        document.getElementById("messages").scrollTop = document.getElementById("messages").scrollHeight;
      }
    };
    xhr.send();
  }

  function sendMessage() {
    const msg = document.getElementById("msgInput").value.trim();
    if (msg === "") return;

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "send_message.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
      if (this.status === 200) {
        document.getElementById("msgInput").value = "";
        loadMessages();
      }
    };
    xhr.send("to=" + chatWith + "&message=" + encodeURIComponent(msg));
  }

  setInterval(loadMessages, 1000);
  loadMessages();
</script>

</body>
</html>
