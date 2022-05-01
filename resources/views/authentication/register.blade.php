<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login V3</title>
</head>
<body>
<div>
    @if($errors->any())
        {{ implode('', $errors->all('<div>:message</div>')) }}
    @endif
    <form action="/register" method="post">
        @csrf

        <label>
            <input name="name" type="text" placeholder="name" required>
        </label>
        <label>
            <input name="email" type="email" placeholder="email" required>
        </label>
        <label>
            <input name="password" type="password" placeholder="password" required>
        </label>
        <label>
            <input name="password_confirmation" type="password" placeholder="password_confirmation" required>
        </label>

        <button type="submit">Login</button>

    </form>
</div>
</body>
</html>

