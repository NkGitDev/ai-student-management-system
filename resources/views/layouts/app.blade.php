<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- Logo -->
    <link rel="icon" href="{{ asset('assets/images/Logo/FSD_Logo.png') }}" type="image/x-icon">

    <!-- Theme Custom CSS Files -->
    <link href="{{ asset('assets/css2/bootstrap-creative.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css2/app-creative.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css2/icons.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Bootstrap 5 CSS (Theme ke CSS ke baad overload se bachne ke liye) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Icons: Bootstrap Icons & FontAwesome (Password Eye Icon & Carousel Fixes) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <!-- Mixed Content (HTTP to HTTPS) Fix: Only Active in Production (Local environment disturb nahi hoga) -->
    @if(app()->environment('production'))
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    @endif

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <!-- Theme set before page render to avoid flicker -->
    <script>
        const savedTheme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-bs-theme', savedTheme);
        if (document.body) {
            document.body.className = savedTheme + '-theme';
        }
    </script>
</head>
<!-- <body class="d-flex flex-column min-vh-100"> -->




<!-- ================= AI Floating Chatbot Widget ================= -->
<!-- Chat Floating Button -->
<button id="aiChatToggleBtn" onclick="toggleAIChat()" style="position: fixed; bottom: 25px; right: 25px; z-index: 9999; border-radius: 50%; width: 60px; height: 60px; background-color: #0d6efd; color: white; border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.3); cursor: pointer; display: flex; align-items: center; justify-content: center; transition: transform 0.2s;">
    <span id="aiChatIcon" style="font-size: 26px;">💬</span>
</button>

<!-- Chat Window Box -->
<div id="aiChatBox" style="display: none; position: fixed; bottom: 95px; right: 25px; width: 350px; max-width: 90vw; height: 460px; background-color: #ffffff; border-radius: 12px; box-shadow: 0 5px 25px rgba(0,0,0,0.2); z-index: 9999; flex-direction: column; overflow: hidden; font-family: sans-serif; border: 1px solid #e0e0e0;">
    
    <!-- Chat Header -->
    <div style="background-color: #0d6efd; color: white; padding: 12px 16px; display: flex; justify-content: space-between; align-items: center;">
        <div style="display: flex; align-items: center; gap: 8px;">
            <span style="font-size: 20px;">🤖</span>
            <div>
                <strong style="display: block; font-size: 15px;">Student AI Assistant</strong>
                <small style="font-size: 11px; opacity: 0.85;">Online | Powered by Groq</small>
            </div>
        </div>
        <button onclick="toggleAIChat()" style="background: none; border: none; color: white; font-size: 20px; cursor: pointer; line-height: 1;">&times;</button>
    </div>

    <!-- Chat Messages Container -->
    <div id="aiChatMessages" style="flex: 1; padding: 15px; overflow-y: auto; background-color: #f8f9fa; display: flex; flex-direction: column; gap: 10px;">
        <div style="background-color: #e9ecef; color: #212529; padding: 10px 14px; border-radius: 12px 12px 12px 0; max-width: 85%; font-size: 14px; align-self: flex-start; line-height: 1.4;">
            Namaste! 👋 Main aapka Student Support AI hoon. Aap mujhse courses, registration, ya payment details ke baare mein kuch bhi pooch sakte hain!
        </div>
    </div>

    <!-- Chat Input Form -->
    <form onsubmit="sendAIChatMessage(event)" style="display: flex; padding: 10px; background-color: #ffffff; border-top: 1px solid #dee2e6; gap: 8px;">
        <input type="text" id="aiUserInput" placeholder="Type your question..." required style="flex: 1; padding: 8px 12px; border: 1px solid #ced4da; border-radius: 20px; outline: none; font-size: 14px;">
        <button type="submit" id="aiSendBtn" style="background-color: #0d6efd; color: white; border: none; border-radius: 50%; width: 38px; height: 38px; cursor: pointer; display: flex; align-items: center; justify-content: center; font-size: 16px;">➤</button>
    </form>
</div>

<!-- Chatbot JavaScript Logic -->
<script>
function toggleAIChat() {
    const chatBox = document.getElementById('aiChatBox');
    const chatIcon = document.getElementById('aiChatIcon');
    if (chatBox.style.display === 'none' || chatBox.style.display === '') {
        chatBox.style.display = 'flex';
        chatIcon.innerHTML = '✖';
    } else {
        chatBox.style.display = 'none';
        chatIcon.innerHTML = '💬';
    }
}

function sendAIChatMessage(e) {
    e.preventDefault();
    const inputField = document.getElementById('aiUserInput');
    const message = inputField.value.trim();
    if (!message) return;

    const messagesContainer = document.getElementById('aiChatMessages');

    // 1. User Ka Message Render Karein
    const userMsgDiv = document.createElement('div');
    userMsgDiv.style.cssText = 'background-color: #0d6efd; color: white; padding: 10px 14px; border-radius: 12px 12px 0 12px; max-width: 85%; font-size: 14px; align-self: flex-end; line-height: 1.4; word-wrap: break-word;';
    userMsgDiv.innerText = message;
    messagesContainer.appendChild(userMsgDiv);

    inputField.value = '';
    messagesContainer.scrollTop = messagesContainer.scrollHeight;

    // 2. Typing/Loading Indicator Show Karein
    const loadingDiv = document.createElement('div');
    loadingDiv.id = 'aiTypingIndicator';
    loadingDiv.style.cssText = 'background-color: #e9ecef; color: #6c757d; padding: 8px 12px; border-radius: 12px; max-width: 85%; font-size: 13px; align-self: flex-start; font-style: italic;';
    loadingDiv.innerText = '🤖 AI is typing...';
    messagesContainer.appendChild(loadingDiv);
    messagesContainer.scrollTop = messagesContainer.scrollHeight;

    // 3. Relative URL (`/ai-chat`) Se Backend Ko Call Karein
    fetch('/ai-chat', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]') ? document.querySelector('meta[name="csrf-token"]').getAttribute('content') : ''
        },
        body: JSON.stringify({ message: message })
    })
    .then(response => response.json())
    .then(data => {
        const typingIndicator = document.getElementById('aiTypingIndicator');
        if (typingIndicator) typingIndicator.remove();

        const botMsgDiv = document.createElement('div');
        botMsgDiv.style.cssText = 'background-color: #e9ecef; color: #212529; padding: 10px 14px; border-radius: 12px 12px 12px 0; max-width: 85%; font-size: 14px; align-self: flex-start; line-height: 1.4; word-wrap: break-word;';

        if (data.success) {
            botMsgDiv.innerText = data.reply;
        } else {
            botMsgDiv.innerText = 'Error: ' + (data.message || 'Something went wrong.');
            botMsgDiv.style.backgroundColor = '#f8d7da';
            botMsgDiv.style.color = '#842029';
        }
        messagesContainer.appendChild(botMsgDiv);
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    })
    .catch(error => {
        const typingIndicator = document.getElementById('aiTypingIndicator');
        if (typingIndicator) typingIndicator.remove();

        const errorDiv = document.createElement('div');
        errorDiv.style.cssText = 'background-color: #f8d7da; color: #842029; padding: 10px 14px; border-radius: 12px; max-width: 85%; font-size: 13px; align-self: flex-start;';
        errorDiv.innerText = 'Network error: Server se connect nahi ho paaya.';
        messagesContainer.appendChild(errorDiv);
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    });
}
</script>
<!-- ================= End AI Floating Chatbot Widget ================= -->




<body>

    <!-- Include Navbar -->
    @include('partials.navbar')

    <!-- Include Sidebar -->
    @include('partials.sidebar')
    

    <main class="content">
        @yield('content')
    </main>

    
    



    <!-- Bootstrap JS & dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Feather Icons -->
    <!-- <script>
        feather.replace();
    </script> -->
    @livewireScripts


    <script src="{{ asset('assets/js2/vendor.min.js') }}"></script>
    <script src="{{ asset('assets/js2/app.min.js') }}"></script>
    <!-- <script src="{{ asset('assets/js/app.js') }}"></script> -->
     
    <script>
        function toggleSidebar() {
            const sidebar = document.querySelector('#sidebar');
            sidebar.classList.toggle('collapsed');
        }
    </script>

</body>
</html>