<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <title>Laravel File Upload</title>
        <style>
            .container {
                max-width: 600px;
            }
            dl, ol, ul {
                margin: 0;
                padding: 0;
                list-style: none;
            }
            .custom-label{
                width:20%;
            }
            .custom-input{
                width:30%;
            }
           
        </style>
    </head>
    <body>
        
        <div class="container mt-5">
            <form action="{{route('update')}}" method="post" enctype="multipart/form-data">
                <h3 class="text-center mb-5">Upload File in Laravel</h3>
                @csrf
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <!-- <div class="custom-file form-group">                    
                    <label style="">Name</label>
                    <input type="text" name="stuName" >
                </div>

                <div class="custom-file">                    
                    <label style="" class="custom-label">Roll Number</label>
                    <input type="tel" class="custom-input" name="roll_no" >
                </div>

                <div class="custom-file">                    
                    <label style="">Phone Number</label>
                    <input type="tel" name="phone" >
                </div>

                <div class="custom-file">                    
                    <label style="">Email</label>
                    <input type="email" name="email" >
                </div>

                <div class="custom-file">                    
                    <label style="">Password</label>
                    <input type="password" name="stu_password" >
                </div>

                
               
                     //if input id is working  -->
                <!-- <div class="custom-file"> -->
                    <!-- <input type="file" name="documents" class="custom-file-input" id="chooseFile"> -->
                    <!-- <label class="custom-file-label" style="cursor:pointer;" for="chooseFile">Select Document</label> -->
                <!-- </div> --> 

                <div class="custom-file">
                    <input type="file" name="file" class="custom-file-input" id="chooseFile">
                    <label class="custom-file-label" style="cursor:pointer;" for="chooseFile">Select file</label>
                </div>
                <button type="submit" name="submit" class="btn btn-primary btn-block mt-4">
                    submit
                </button>
            </form>
        </div>
    </body>
</html>