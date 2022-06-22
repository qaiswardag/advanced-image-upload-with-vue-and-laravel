<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Advanced Image Uploading with Vue and Laravel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

<div class="container mx-auto mt-24 py-20 md:px-12 px-8">
    <div class="border border-gray-300 min-h-screen py-20 md:px-12 px-8">
        <h1 class="text-4xl font-bold text-center">
            Image uploader
        </h1>
        <div id="app">
            {{--Vue component--}}
            <app></app>
        </div>
    </div>
</div>


<script src="{{ mix('js/app.js') }}"></script>

</body>
</html>
