<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

</head>

<body class="antialiased">

    <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
        <div class="max-w-4xl mx-auto p-6 lg:p-8">
            <h1 class="text-center text-4xl py-8 font-light">Emoticon Generator</h1>

            <div class="p-6 bg-gray-50 border rounded-lg shadow-lg">
                <div id="emoticon-container">
                    <div class="flex items-center w-ful">
                        <input type="text" class="p-2 text-lg focus:outline-none bg-transparent" value="{{ e('anger') }}">
                        <div id="loading-container" class="invisible">
                            <svg fill="none" class="h-8 w-8 animate-spin text-orange-600" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                                <path clip-rule="evenodd" d="M15.165 8.53a.5.5 0 01-.404.58A7 7 0 1023 16a.5.5 0 011 0 8 8 0 11-9.416-7.874.5.5 0 01.58.404z" fill="currentColor" fill-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    <div style="margin: 50px 200px ">
                        <p id="emoji-display" class="mt-4 text-center w-full text-9xl">
                            🤬
                        </p>
                    </div>
                </div>
            </div>
        </div>
</body>
<script>
    const emoticonForm = document.querySelector('#emoticon-container');
    const userInput = emoticonForm.querySelector('input[type="text"]');
    const emojiDisplay = emoticonForm.querySelector('p');
    userInput.addEventListener('input', debounce((event) => {
        fetchEmoji();
    }, 500));

    function fetchEmoji() {
        const userInput = emoticonForm.querySelector('input[type="text"]');
        const emojiDisplay = document.getElementById('emoji-display');
        const loadingContainer = document.querySelector('#loading-container');
        loadingContainer.classList.remove('invisible');

        fetch(`/api/emoji?content=${userInput.value}`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then((response) => response.json())
            .then(({
                content
            }) => {
                emojiDisplay.innerText = content;
                loadingContainer.classList.add('invisible');
            })
            .catch(error => console.error(error))
    }

    function debounce(callback, delay) {
        let timeoutId;

        return function() {
            const args = arguments;
            const context = this;

            clearTimeout(timeoutId);

            timeoutId = setTimeout(function() {
                callback.apply(context, args);
            }, delay);
        };
    }
</script>

</html>