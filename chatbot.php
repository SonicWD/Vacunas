<!-- chatbot.php -->
<style>
    #chatbot-container {
        position: fixed;
        bottom: 20px;
        right: 20px;
        width: 300px;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        z-index: 9999;
    }

    #chatbot-messages {
        max-height: 200px;
        overflow-y: scroll;
    }
</style>

<div id="chatbot-container">
    <div id="chatbot-messages"></div>
    <input type="text" id="chatbot-input" placeholder="Escribe tu mensaje...">
    <button id="chatbot-send">Enviar</button>
</div>

<script>
    function sendMessage() {
        var input = document.getElementById("chatbot-input");
        var message = input.value;
        input.value = "";

        var messagesContainer = document.getElementById("chatbot-messages");
        messagesContainer.innerHTML += '<div class="user-message">' + message + '</div>';

        var response = "¡Hola! Soy un chatbot. ¿En qué puedo ayudarte?";
        messagesContainer.innerHTML += '<div class="chatbot-message">' + response + '</div>';

        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }

    var sendButton = document.getElementById("chatbot-send");
    sendButton.addEventListener("click", sendMessage);

    var inputField = document.getElementById("chatbot-input");
    inputField.addEventListener("keypress", function(event) {
        if (event.key === "Enter") {
            sendMessage();
        }
    });
</script>

