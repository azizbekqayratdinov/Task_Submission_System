<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
</head>
<body>
    <h1>Admin | <a href="{{route('logout')}}" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
        Logout
      </a></h1>
    <a href="{{route('add_student')}}">Add Student</a> | <a href="{{route('add_teacher')}}">Add Teacher</a> <br><br>
    <a href="{{route('t_group')}}">Add Group to Teacher</a> | <br><br>
    <a href="">Add Subject</a> | 
    <a href="">Add Group</a>
</body>
</html>