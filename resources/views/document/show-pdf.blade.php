<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>document</title>
</head>
<body>
    <h3>{{$document->title}}</h3>
        <p>{!! $document-> path !!}</p>
        <p>{{$document->documentHasUser->name}}</p>
</body>
</html>