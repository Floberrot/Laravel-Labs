<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Book Created</title>
</head>
<body>
<h1>📚 A new book has been created!</h1>

<p><strong>Title:</strong> {{ $book->title }}</p>
<p><strong>Author:</strong> {{ $book->author }}</p>
<p><strong>Published at:</strong> {{ optional($book->published_at)->format('Y-m-d') }}</p>

<hr>
<p>Thanks,<br>{{ config('app.name') }}</p>
<img src="{{ $message->embed(public_path('images/logo.png')) }}" alt="Laravel logo">
</body>
</html>
