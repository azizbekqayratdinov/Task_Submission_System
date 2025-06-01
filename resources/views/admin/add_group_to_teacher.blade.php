<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Teacher's group</title>
</head>

<body>
    <form action="{{route('tg_store')}}" method="post">
        @csrf
        <label for="1">Teachers :</label>
        <select name="teacher_id" id="1">
            @foreach ($teachers as $teacher)
                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
            @endforeach
        </select><br><br>
        <label for="2">Subjects :</label>
        <select name="subject_id" id="2">
            @foreach ($subjects as $subject)
                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
            @endforeach
        </select><br><br>
        <label for="3">Groups :</label>
        <select name="group_id" id="3">
            @foreach ($groups as $group)
                <option value="{{$group->id}}">{{$group->name}}</option>
            @endforeach
        </select><br><br>
        <input type="submit" value="Add">
    </form>
</body>

</html>
