<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Semantic UI Chatbox</title>

  <!-- Semantic UI CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.5.0/semantic.min.css">

  <style>
    body {
      background: #f7f7f7;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .chat-container {
      width: 400px;
      height: 600px;
      display: flex;
      flex-direction: column;
    }

    .chat-box {
      flex: 1;
      overflow-y: auto;
      padding: 10px;
      background: white;
      border: 1px solid #ddd;
      border-radius: 5px;
    }

    .message {
      margin-bottom: 10px;
    }

    .message.user {
      text-align: right;
    }

    .message .content {
      display: inline-block;
      padding: 8px 12px;
      border-radius: 12px;
      max-width: 70%;
    }

    .message.user .content {
      background: #2185d0;
      color: white;
    }

    .message.bot .content {
      background: #e0e0e0;
    }

    .input-area {
      margin-top: 10px;
    }
  </style>
</head>

<body>

<div class="ui segment chat-container">

  <div id="chatBox" class="chat-box">
    <div class="message bot">
      <div class="content">Hello! How can I help you?</div>
    </div>
  </div>

  <div class="ui action input input-area">
    <input id="messageInput" type="text" placeholder="Type a message...">
    <button class="ui primary button" onclick="sendMessage()">Send</button>
  </div>

</div>

<!-- Script -->
<script>
  function sendMessage() {
    const input = document.getElementById("messageInput");
    const chatBox = document.getElementById("chatBox");
    const text = input.value.trim();

    if (!text) return;

    // Add user message
    const userMsg = document.createElement("div");
    userMsg.className = "message user";
    userMsg.innerHTML = `<div class="content">${text}</div>`;
    chatBox.appendChild(userMsg);

    // Simulated bot reply
    const botMsg = document.createElement("div");
    botMsg.className = "message bot";
    botMsg.innerHTML = `<div class="content">You said: ${text}</div>`;

    setTimeout(() => {
      chatBox.appendChild(botMsg);
      chatBox.scrollTop = chatBox.scrollHeight;
    }, 500);

    input.value = "";

    // Auto-scroll
    chatBox.scrollTop = chatBox.scrollHeight;
  }

  // Enter key support
  document.getElementById("messageInput").addEventListener("keypress", function(e) {
    if (e.key === "Enter") sendMessage();
  });
</script>

</body>
</html>