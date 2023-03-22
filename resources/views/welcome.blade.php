<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://api.fontshare.com/v2/css?f[]=supreme@400&f[]=technor@600,400&display=swap" rel="stylesheet">

    @vite(['public/scss/app.scss', 'public/css/app.css'])

    <title>ChatBot</title>
</head>

<body>
    <div>
        <div class="header">
            <h1>ChatBot</h1>
            <p>OpenAI API - ChatGPT 3.5</p>
        </div>
        <div class="container">
            <div class="chat-window">
                <div class="messages-user">
                    <div class="__user">
                        <p>Hello world Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab ad animi assumenda commodi consequatur consequuntur doloremque, ea earum esse facere laudantium maiores nostrum odit quaerat quis saepe sed sunt voluptates.</p>
                    </div>
                    <img src="{{ asset('/images/avatar.png') }}" alt="Avatar">
                    <div style="clear: both"></div>
                </div>
                <div class="messages-bot">
                    <img src="{{ asset('/images/chatbot.png') }}" alt="Avatar">
                    <div class="__bot">
                        <p>Hello world Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum dolorem ea enim fugiat quasi tempore, voluptas! Ab amet at consectetur excepturi expedita hic id, mollitia quaerat ratione recusandae temporibus voluptatum.</p>
                    </div>
                </div>
                <div class="type-bar">
                        <input type="text" placeholder="Entrez votre message...">
                        <img src="{{ asset('/images/send.png') }}" alt="send">
                </div>
            </div>
        </div>
    </div>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
    </script>
</body>
</html>
