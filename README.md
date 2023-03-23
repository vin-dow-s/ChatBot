# ChatBot :computer:
### OpenAI API - ChatGPT 3.5 :robot:
This Laravel project uses the following OpenAI API : https://github.com/openai-php/laravel with a backend implementation.

The route is defined in ``api.php`` and calls the function in ``ChatBotController`` which uses the OpenAI completion method with following parameters :   

`'max_tokens' => 150,     
'model' => 'text-davinci-003',     
'prompt' => $request->input('input')`     

A single Blade template contains the front-end part, including the JavaScript API fetch function.
