<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>blog</title>
</head>
<body>
    <h3>{{$blogPost->title}}</h3>
        <p>{!! $blogPost-> body !!}</p>
        <p>      <strong>Category: @isset($blogPost->blogHasCategory->categorie) {{ $blogPost->blogHasCategory->categorie}} @endisset</strong>
        <p>{{$blogPost->blogHasUser->name}}</p>
</p>
</body>
</html>