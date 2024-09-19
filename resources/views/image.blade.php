<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petclick</title>
</head>
<body>
    $foreach($rec->where('app_id',$appointment->id) as $rc)
    <img src="{!! asset('storage/'. $rc->receipt) !!}" alt="receipt">
    $endforeach
</body>
</html>