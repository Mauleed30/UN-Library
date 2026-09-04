<!DOCTYPE html>
<html>
<head>
    <title>Edit Post</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        input, textarea { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; border-radius: 5px; }
        button { padding: 10px 20px; background: blue; color: white; border: none; border-radius: 5px; cursor: pointer; }
        .container { max-width: 600px; margin: auto; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Post</h1>
        <a href="/posts">← Back to Posts</a>

        <form action="/posts/{{ $post->id }}" method="POST">
            @csrf
            @method('PUT')
            <input type="text" name="title" placeholder="Post Title" value="{{ $post->title }}" required>
            <textarea name="content" placeholder="Post Content" rows="5" required>{{ $post->content }}</textarea>
            <input type="text" name="author" placeholder="Author Name" value="{{ $post->author }}" required>
            <button type="submit">Update Post</button>
        </form>
    </div>
</body>
</html>
