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
           
            .custom-label{
                width:20%;
            }
            .custom-input{
                width:30%;
            }
            /* input[type="file"] { 
            z-index: -1;
            position: absolute;
            opacity: 0;
            }

            input:focus + label {
            outline: 2px solid;
            } */
        </style>
    </head>
    <body>           
        <div class="container mt-5">
            <form action="{{route('fileUpload') }}" method="post" enctype="multipart/form-data">
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

                <div class="custom-file">
                    <input type="file" name="file" class="custom-file-input" id="chooseFile">
                    <label class="custom-file-label"  for="chooseFile"> <span id="file-upload-filename"></span></label>                   
                </div>
                
                <button type="submit" name="submit" class="btn btn-primary btn-block mt-4">Add</button>
            </form>

        </div>

        <script>
            var input = document.getElementById( 'chooseFile' );
            var infoArea = document.getElementById( 'file-upload-filename' );
            input.addEventListener( 'change', showFileName );
            function showFileName( event ) {            
            // the change event gives us the input it occurred in 
            var input = event.srcElement;            
            // the input has an array of files in the `files` property, each one has a name that you can use. We're just using the name here.
            var fileName = input.files[0].name;           
            // use fileName however fits your app best, i.e. add it into a div
            infoArea.textContent = '' + fileName;
            }
        </script>
    </body>
</html>