</html><!DOCTYPE html>
<html lang="en">
<head>
  <title>File Upload Laravel</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <style>
    *{
        margin:0px;
        padding:0px;
        font-size:18px;
    }


    .table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
        padding: 10px 27px;
        line-height: 1.42857143;
        vertical-align: top;
        border-top: 1px solid #ddd;

    }
    body{
        background:#f9f9fb;
    }
    h2{
        margin:60px 0px 30px 0px;
        text-align: center;
    }
    td{
        text-align:center;
    }
    .container {
        width: 1000px;  
        margin:auto;
            }
          
    .custom-label{
        width:20%;
    }
    .custom-input{
        width:30%;
    }
 
    a{
        text-align:center;
        height:20px;
        width:20px;
        color:black;
        font-size:17px;
        /* border:1px solid black; */
        padding:3px 6px;
    }

    table{
        border-spacing: 10px;
    }
    th, td {
  padding: 15px;
  text-align: left;
}
.mw70{ min-width: 70px; }
.al{
    margin-right:20px;

}
.m{
    font-size: 48px;
    margin-left: 17px;
    margin-bottom: 18px;
}
  </style>
</head>
<body>
    <div class="container">      
        <h2>Uploaded File Details</h2>
        <a href="{{route('fileUpload') }}"><i class="fa fa-plus-square al m" style="font-size:48px;"></i></a>
        <table class="table" >       
            <thead class="thead-light">
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Size</th>
                    <th scope="col">Icon</th>
                    <th scope="col">Name</th>
                    <th scope="col">Path</th>
                    <th scope="col">Extension</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($fileModel as $file)                    
                    <tr>
                        <td>{{$file->id}}</td>
                        <td class="mw70">{{$file->size}}</td>
                        <td><i class="fa fa-file-{{$icons[$file->extension]}}-o fa-5x text-center" style="font-size:20px"></i></td>
                        <td>{{$file->name}}</td>
                        <td>{{$file->file_path}}</td>
                        <td>{{$file->extension}}</td>
                        <td>
                            <a href="{{'edit/'.$file->id}}"><i class='far fa-edit' style='font-size:28px;'></i></a>
                        </td>            
                        <td>
                            <div style="display:flex;"> 
                                <form action="{{url('/delete/'.$file->id)}}" method="post" id="deleteForm">
                                    @csrf
                                   
                                   <button type="submit" name="delete" onclick="javascript: return confirm('Are you sure to delete?');" value="Delete"
                                    style=" color:black;font-size:36px;"class="del"> <i class="material-icons">&#xe872; </i></button> 
                                    
                                </form>
                            </div>
                        </td>
                        </tr>
                    <tr>                    
                    @endforeach
                </tbody>
            </table>
    </div>
</body>
</html>


