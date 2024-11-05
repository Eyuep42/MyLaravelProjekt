<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @auth
        <p>You are Logged in</p>
    <form action={{url("/logout")}} method="post">
       @csrf
       <button>Loguout</button> 
    </form>

    <div style="border: 3px solid black">
        <h2>Create a new Post</h2>
        <form action="{{url('create-post') }}" method="POST">
            @csrf
            <input type="text" name="title" placeholder="Title">
            <textarea name="body" placeholder="Contend"></textarea>

            <button>Save Post</button>
        </form>
    </div>
    <div style="border: 3px solid black">
        <h2>All Posts</h2>
        @foreach ($posts as $post)
        <div style="background-color: gray; paddind:10px; margin:10px;">
            <h3>{{$post['title']}} by {{$post->user->name}}</h3>
            {{$post['body']}}
            <p><a href="{{ route('post.update', $post->id) }}">Edit</a></p>
            <form action="{{url('/delete-post/' . $post->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <button>Delete</button>
            </form>
        </div>
        @endforeach
    </div>
    @else
    <div style="border: 3px solid black">
        <h2>Register</h2>
        <form action="{{ url('/register') }}" method="POST">
            @csrf
            <input type="text" name="name" placeholder="name">
            <input type="text" name="email" placeholder="email">
            <input type="password" name="password" placeholder="password">
            <button type="submit">Register</button>
        </form>
    </div>
    <div style="border: 3px solid black;">
        <h2>Login</h2>
        <form action="{{ url('/login') }}" method="POST">
            @csrf
            <input type="text" name="loginName" placeholder="name">
            <input type="password" name="loginPassword" placeholder="password">
            <button type="submit">Login</button>
        </form>
    </div>
    @endauth
</body>
</html>
