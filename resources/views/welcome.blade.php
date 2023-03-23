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
                <!-- Div messages-user AJAX -->
                <!-- Div messages-bot AJAX -->
                <div class="type-bar">
                        <input id="input" name="input" type="text" placeholder="Entrez votre message...">
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

        //VARIABLES
        const button = document.getElementById('button-submit');
        const chatWindow = document.getElementById('chat-window');
        const url = '{{ url('/api/send') }}';
        const inputField = document.getElementById('input');

        //API FETCH AND HTML UPDATE
        function fetchAndUpdateHTML() {
            const input = document.getElementById('input').value;
            if(isInputValid(input)){
                chatWindow.insertAdjacentHTML('beforeend', `<div class="messages-user">
                                <div class="__user">
                                    <p>${input}</p>
                                </div>
                                <img src="{{ asset('/images/avatar.png') }}" alt="Avatar">
                                <div style="clear: both"></div>
                                </div>`);
                inputField.value = '';

                fetch(url, {
                    method: 'POST',
                    body: JSON.stringify({input: input}),
                    headers: {
                        'Content-Type': 'application/json',
                    }
                }).then(function (response) {
                    if (response.ok) {
                        console.log(response);
                        return response.text();
                    } else {
                        throw new Error('Server error.');
                    }
                }).then(function (data) {
                    chatWindow.insertAdjacentHTML('beforeend', `<div class="messages-bot">
                                <img src="{{ asset('/images/chatbot.png') }}" alt="Avatar">
                                <div class="__bot">
                                    <p>${data}</p>
                                </div>
                                </div>
                                `);
                    const typeBar = document.querySelector('.type-bar');
                    typeBar.scrollIntoView({block: 'end', inline: 'nearest', behavior: 'smooth'});
                }).catch(function (error) {
                    console.log('Fetch error:', error.message);
                });
            }
        }

        //CALL FETCH ON BUTTON CLICK
        button.addEventListener('click', fetchAndUpdateHTML);

        //CALL FETCH ON ENTER KEY
        inputField.addEventListener('keydown', function (event){
            if (event.key === 'Enter'){
                event.preventDefault();
                fetchAndUpdateHTML();
                inputField.value = '';
            }
        })

        //CHECK IF USER INPUT IS NOT EMPTY OR SPACES ONLY
        function isInputValid(input) {
            return input.trim() !== '' && true;
        }
    </script>
</body>
</html>
