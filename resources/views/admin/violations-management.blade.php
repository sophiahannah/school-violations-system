<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <div class="">Admin</div>
    <form action="{{ route('logout')}}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>

    <div>
        <div>
          Violations Management
        </div>
        <br>
        <div>
            Violation Logs:

            @foreach ($violationRecords as $violationRecord)
            <div>
                {{ $violationRecord }}
            </div>
            @endforeach
        </div>
    </div>
</body>

</html>