<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact Me</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<h3>Last 10 Properties</h3>
<table class="table table-hover table-striped">
    <thead>
    <tr>
        <th>Name</th>
        <th>Address</th>
        <th>Description</th>
        <th>Price</th>
    </tr>
    </thead>
    <tbody>
    @foreach($properties as $property)
        <tr>
            <td>{{ $property->name_en }}</td>
            <td>{{ $property->address }}</td>
            <td>{{ $property->description_en }}</td>
            <td>{{ $property->price }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>