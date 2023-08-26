</html><!DOCTYPE html>
<html lang="en">
<head>
  <title>File Upload Laravel</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <style>
    body{
        background:#f9f9fb;
    }
    h2{
        /* font-weight: bold;
        color: #1f1f1f; */
        text-align: center;
        /* margin: 20px;
        font-size: 31px; */
    }
    
  </style>
</head>
<body>

    <div class="container">
    
    <section class="maincont1">
       
    <h2>Uploaded File Details</h2>
        <table class="table">
      
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
                @foreach ($students as $student)    
                    <tr>
                   
                    <td>{{$student->id}}</td>
                    <td>{{$student->size}}</td>
                    
                    <td>{{$student->stu_name}}</td>
                    <td>{{$student->file_path}}</td>
                    <td>{{$student->extension}}</td>
                    <td><a href="{{url('/edit/'.$student->id)}}">Edit</a></td>
                    <td>
                        <div style="display:flex;"> 
                            <form action="{{url('/delete/'.$student->id)}}" method="post">
                                @csrf
                                <button type="submit" style="border:none;">delete</button>    
                            </form>
                        </div>
                    </td> 
                    </tr>
                    <tr>
                
                @endforeach



            </tbody>
        </table>
        
        <a href="{{url('add_student')}}">Add Student</a>
        </section>

</body>
</html>


