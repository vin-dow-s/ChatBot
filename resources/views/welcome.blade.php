<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://api.fontshare.com/v2/css?f[]=supreme@400&f[]=technor@600,400&display=swap" rel="stylesheet">

    @vite(['public/scss/app.scss', 'public/scss/app.css', 'public/js/app.js'])

    <script src="{{ asset('js/app.js')}}"></script>

    <title>ChatBot</title>
</head>

<body>
    <div>
        <div class="header">
            <h1>ChatBot</h1>
            <p>OpenAI API - ChatGPT 3.5</p>
        </div>
        <div class="container">
            <div id="chat-window" class="chat-window">
                <!-- Div messages-user APPEND HERE -->
                <!-- Div messages-bot APPEND HERE -->
                <div class="type-bar">
                        <input id="input" type="text" placeholder="Entrez votre message...">
                        <button id="button-submit"><img src="{{ asset('/images/send.png') }}" alt="send"></button>
                </div>
            </div>
        </div>
    </div>
    <script>
        //CSRF TOKEN
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const xhr = new XMLHttpRequest();
        xhr.open('GET', 'https://api.openai.com/v1/chat/completions', true);
        xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);

        const button = document.getElementById('button-submit');
        const chatWindow = document.getElementById('chat-window');
        const url = '{{ url('/send') }}';

        //API FETCH ON BUTTON CLICK
        button.addEventListener('click', function (){
            const input = document.getElementById('input').value;

            chatWindow.innerHTML += `<div class="messages-user">
            <div class="__user">
                <p>${input}</p>
            </div>
            <img src="{{ asset('/images/avatar.png') }}" alt="Avatar">
            <div style="clear: both"></div>
        </div>`;

            fetch(url, {
                method: 'POST',
                body: JSON.stringify(input),
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer "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"',
                }
            }).then(function(response) {
                if (response.ok) {
                    return response.text();
                } else {
                    throw new Error('Server error.');
                }
            }).then(function(data) {
                chatWindow.innerHTML += `<div class="messages-bot">
                                <div class="__bot">
                                    <p>${data}</p>
                                </div>
                                <img src="{{ asset('/images/chatbot.png') }}" alt="Avatar">
                                </div>
                                `;
            }).catch(function(error) {
                console.log('Fetch error:', error.message);
            });
        });
    </script>
</body>
</html>
