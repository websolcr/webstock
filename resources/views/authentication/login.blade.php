<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login V3</title>
</head>
<body>
<div>
    <form action="/login" method="post">
        @csrf

        <label>
            <input name="email" type="email" placeholder="email" required>
        </label>
        <label>
            <input name="password" type="password" placeholder="password" required>
        </label>

        <button type="submit">Login</button>

    </form>
</div>
</body>
</html>

