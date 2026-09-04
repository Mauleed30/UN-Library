<!DOCTYPE html>
<html>
<head>
    <title>Create Post</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f4f4f4; }
        .container { max-width: 600px; margin: auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        input, textarea { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; border-radius: 5px; }
        button { padding: 10px 20px; background: blue; color: white; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { background: darkblue; }
    </style>
</head>
<body>
    <div class="container">
        <h1>📝 Create New Post</h1>
        <a href="/posts">← Back to Posts</a>

        <form action="/posts" method="POST">
            @csrf
            <input type="text" name="title" placeholder="Post Title" required>
            <textarea name="content" placeholder="Post Content" rows="5" required></textarea>
            <input type="text" name="author" placeholder="Author Name" required>
            <button type="submit">💾 Save Post</button>
        </form>
    </div>
</body>
</html>
