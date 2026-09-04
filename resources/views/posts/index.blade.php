<!DOCTYPE html>
<html>
<head>
    <title>Posts List</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .post { border: 1px solid #ddd; padding: 15px; margin: 10px 0; border-radius: 5px; }
        .btn { padding: 8px 15px; background: blue; color: white; text-decoration: none; border-radius: 5px; }
        .btn-danger { background: red; border: none; cursor: pointer; }
        .container { max-width: 800px; margin: auto; }
    </style>
</head>
<body>
   <div class="container">
 <h1>📝 Posts List</h1>
        <a href="/posts/create" class="btn">+ Create New Post</a>

        @if(session('success'))
            <p style="color: green; background: #d4edda; padding: 10px; border-radius: 5px;">
                {{ session('success') }}
            </p>
        @endif

 @foreach($posts as $post)
            <div class="post">
                <h2>{{ $post->title }}</h2>
                <p>{{ $post->content }}</p>
                <small>✍️ Author: {{ $post->author }}</small>
                <br><br>
                <a href="/posts/{{ $post->id }}/edit" class="btn">✏️ Edit</a>
                <form action="/posts/{{ $post->id }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">🗑️ Delete</button>
                </form>
            </div>
        @endforeach
    </div>
</body>
</html>
