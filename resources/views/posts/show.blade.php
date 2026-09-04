<!DOCTYPE html>
<html>
<head>
    <title>{{ $post->title }}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .post { border: 1px solid #ddd; padding: 20px; border-radius: 5px; max-width: 800px; margin: auto; }
        .btn { padding: 8px 15px; background: blue; color: white; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="post">
        <a href="/posts">← Back to Posts</a>
        <h1>{{ $post->title }}</h1>
        <p>{{ $post->content }}</p>
        <small>Author: {{ $post->author }}</small>
        <br><br>
        <a href="/posts/{{ $post->id }}/edit" class="btn">Edit Post</a>
    </div>
</body>
</html>
