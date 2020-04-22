<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact Me</title>
</head>
<body>
<h1>Last 10 Properties</h1>

<table class="table table-striped">
    <tr>
        <td>Name</td>
        <td>Address</td>
        <td>Description</td>
        <td>Price</td>
    </tr>
    @foreach($properties as $property)
        <tr>
            <td>{{$property->name_en}}</td>
            <td>{{$property->address}}</td>
            <td>{{$property->description_en}}</td>
            <td>{{$property->price}}</td>
        </tr>
    @endforeach
</table>

</body>
</html>
