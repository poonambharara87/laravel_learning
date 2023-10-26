<!DOCTYPE html>
<html>
<body>

<!-- <h2></h2> -->

<!-- <form action="{{route('register')}}" method="post" enctype="multipart/formdata"> -->
  <label for="fname">Name:</label><br>
  <input type="text" id="fname" name="fname"><br>

  <label for="email">Email:</label><br>
  <input type="email" id="email" name="email">


  <label for="phone">Phone:</label><br>
  <input type="tel" id="phone" name="phone_no">

  <label for="password">Password:</label><br>
  <input type="password" id="password" name="password">

  <label for="gender">Choose Gender:</label>

    <select name="gender" id="gender">
        <option value="0">Male</option>
        <option value="1">Female</option>
        <option value="2">Other</option>
    </select>
</form>


<p></p>

</body>
</html>

