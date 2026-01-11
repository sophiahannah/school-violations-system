<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        <h1>Created this for testing purposes.  Feel free to delete or edit as needed:</h1>
        <div>User_id: {{ $user_id }}</div>  
        <div>Violation_records:</div>
        @foreach($violation_records as $record) 
            <div>{{ $record->violationsanction->violation->violation_name }}</div>
        @endforeach
       
        <div>Violation_id: {{ $violation_id }}</div>
        <div>Violation_count: {{ $violation_count }}</div>
        <div>Violation_sanction_id: {{ $vio_sanct_id }}</div>
        <div>Result: {{ $result }}</div>

        <a href="{{ route('admin.dashboard.index') }}"> Return to dashboard </a>
    </body>
</html>