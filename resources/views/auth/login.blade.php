<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body style="font-family: Arial; text-align:center; margin-top: 50px;">

    <h2>Login</h2>

    @if($errors->any())
        <div style="color: red;">
            <ul style="list-style: none; padding:0;">
                @foreach($errors->all() as $error)
                    <li>⚠ {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login.process') }}">
        @csrf
        <div style="margin-bottom: 10px;">
            <input type="text" name="username" placeholder="Username" value="{{ old('username') }}">
        </div>
        <div style="margin-bottom: 10px;">
            <input type="password" name="password" placeholder="Password">
        </div>
        <button type="submit">Login</button>
    </form>

</body>
</html>
