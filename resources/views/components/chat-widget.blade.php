<style>
    .chat-msg.loading {
        display: flex;
        gap: 4px;
        align-items: center;
    }

    .chat-msg.loading span {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #00c8ff;
        animation: blink-dot 1.4s infinite ease-in-out;
    }

    .chat-msg.loading span:nth-child(2) {
        animation-delay: 0.2s;
    }

    .chat-msg.loading span:nth-child(3) {
        animation-delay: 0.4s;
    }

    @keyframes blink-dot {

        0%,
        80%,
        100% {
            opacity: 0.2;
            transform: scale(0.8);
        }

        40% {
            opacity: 1;
            transform: scale(1);
        }
    }

    .chat-input:disabled,
    .chat-send:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .chat-fab {
        position: fixed;
        bottom: 24px;
        right: 24px;
        z-index: 999;
        width: 56px;
        height: 56px;
        border-radius: 50%;
        background: linear-gradient(135deg, #0055cc, #0099ff);
        border: 1px solid rgba(0, 200, 255, 0.5);
        box-shadow: 0 0 20px rgba(0, 150, 255, 0.5);
        color: #fff;
        font-size: 24px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .chat-panel {
        position: fixed;
        bottom: 92px;
        right: 24px;
        z-index: 999;
        width: 320px;
        height: 420px;
        background: rgba(5, 15, 35, 0.97);
        border: 1px solid rgba(0, 200, 255, 0.25);
        border-radius: 14px;
        display: none;
        flex-direction: column;
        overflow: hidden;
        font-family: 'Inter', sans-serif;
    }

    .chat-panel.open {
        display: flex;
    }

    .chat-header {
        padding: 14px 16px;
        border-bottom: 1px solid rgba(0, 200, 255, 0.15);
        color: #00c8ff;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .chat-messages {
        flex: 1;
        overflow-y: auto;
        padding: 12px;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .chat-msg {
        max-width: 80%;
        padding: 8px 12px;
        border-radius: 10px;
        font-size: 13px;
        line-height: 1.4;
    }

    .chat-msg.user {
        align-self: flex-end;
        background: #0066cc;
        color: #fff;
    }

    .chat-msg.ia {
        align-self: flex-start;
        background: rgba(255, 255, 255, 0.08);
        color: #e0eeff;
    }

    .chat-input-wrap {
        display: flex;
        gap: 8px;
        padding: 10px;
        border-top: 1px solid rgba(0, 200, 255, 0.15);
    }

    .chat-input {
        flex: 1;
        background: rgba(255, 255, 255, 0.06);
        border: 1px solid rgba(0, 200, 255, 0.2);
        border-radius: 8px;
        color: #fff;
        padding: 8px 10px;
        font-size: 13px;
    }

    .chat-input:focus {
        outline: none;
        border-color: #00c8ff;
    }

    .chat-send {
        background: #00aaff;
        border: none;
        color: #fff;
        border-radius: 8px;
        padding: 8px 14px;
        cursor: pointer;
        font-size: 13px;
    }
</style>

<button class="chat-fab" id="chatFab">💬</button>

<div class="chat-panel" id="chatPanel">
    <div class="chat-header">Asistente de Citas</div>
    <div class="chat-messages" id="chatMessages"></div>
    <div class="chat-input-wrap">
        <input type="text" class="chat-input" id="chatInput" placeholder="Escribe tu mensaje...">
        <button class="chat-send" id="chatSend">➤</button>
    </div>
</div>

<script>
    const fab = document.getElementById('chatFab');
    const panel = document.getElementById('chatPanel');
    const input = document.getElementById('chatInput');
    const sendBtn = document.getElementById('chatSend');
    const messagesBox = document.getElementById('chatMessages');

    fab.addEventListener('click', () => {
        panel.classList.toggle('open');
    });

    function agregarMensaje(texto, tipo) {
        const div = document.createElement('div');
        div.className = 'chat-msg ' + tipo;
        div.textContent = texto;
        messagesBox.appendChild(div);
        messagesBox.scrollTop = messagesBox.scrollHeight;
    }

    function enviarMensaje() {
        const texto = input.value.trim();
        if (!texto) return;

        agregarMensaje(texto, 'user');
        input.value = '';

        input.disabled = true;
        sendBtn.disabled = true;

        const loadingDiv = document.createElement('div');
        loadingDiv.className = 'chat-msg ia loading';
        loadingDiv.innerHTML = '<span></span><span></span><span></span>';
        messagesBox.appendChild(loadingDiv);
        messagesBox.scrollTop = messagesBox.scrollHeight;

        fetch('/chat', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                body: JSON.stringify({
                    mensaje: texto
                }),
            })
            .then(res => res.json())
            .then(data => {
                loadingDiv.remove();
                agregarMensaje(data.respuesta, 'ia');
            })
            .catch(() => {
                loadingDiv.remove();
                agregarMensaje('Ocurrió un error, intenta de nuevo.', 'ia');
            })
            .finally(() => {
                input.disabled = false;
                sendBtn.disabled = false;
                input.focus();
            });
    }

    sendBtn.addEventListener('click', enviarMensaje);
    input.addEventListener('keydown', (e) => {
        if (e.key === 'Enter') enviarMensaje();
    });
</script>