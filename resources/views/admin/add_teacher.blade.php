<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Teacher</title>
</head>
<body>
    <form action="{{route('add_teacher_store')}}" method="post">
        @csrf
        <input type="text" name="name" id="" placeholder="Name"><br><br>
        <input type="email" name="email" id="" placeholder="Email"><br><br>
        <input type="password" name="password" id="" placeholder="Password">
        <input type="submit" value="Add">
    </form>
</body>
</html>