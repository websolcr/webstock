<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{config('app.name')}}</title>
</head>
<body>
<div>
    @if($errors->any())
        {{ implode('', $errors->all('<div>:message</div>')) }}
    @endif
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

