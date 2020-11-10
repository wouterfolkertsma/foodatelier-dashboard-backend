<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initiate-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <titel>Import Excel</titel>
</head>
<body>
    <form action="{{ url('/import') }}" method = "post" enctype="multipart/form-data">
        {{csrf_field()}}
        
        @if(session('errors'))
            @foreach($errors as $error)
                <li>{{ $error }} </li>
            @endforeach
        @endif

        @if(session('success')) 
            {{ session('success')}}
        @endif

        <br><br>

        Select excel file to upload
        <br><br>

        <input type="file" name="file" id="file">
        <br><br>
        <button type="submit" >Upload File</button>
        <br><br>
        <a href="{{ url('/sample/sample.xlsx')}}">Download Sample</a>
    </form>
</body>
</html>