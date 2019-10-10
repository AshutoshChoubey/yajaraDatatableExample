<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<style>

form .error {
  color: #ff0000;
} 

</style>
    <title>Hello, world!</title>
  </head>
  <body>
    <h1>Register User </h1>
    <div class="container">
    <div class="row">
    <div class="col-sm-2">
    &nbsp;
    </div>
    <div class="col-sm-8">
    <form action="registerUser" method="post" name="registration" enctype="multipart/form-data">
        @csrf
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="form-control" >
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="form-control" >
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" class="form-control" >
            </div>
            <div class="form-groufp">
                <label for="password_confirmation">Confirm Password:</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" >
            </div>
            <div class="form-group">
                <label for="photo">Upload Profile Photo:</label>
                <input type="file" name="photo" id="photo" class="form-control" >
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
    <div class="col-sm-2">
    &nbsp;
    </div>
    </div>
    
        
</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js" integrity="sha256-sPB0F50YUDK0otDnsfNHawYmA5M0pjjUf4TvRJkGFrI=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script>

$(function() {
    $.validator.addMethod('filesize', function(value, element, param) {
//    console.log()
    return this.optional(element) || (element.files[0].size <= param) 
});

  $("form[name='registration']").validate({
    // Specify validation rules
    rules: {
      name: {
        required: true,
        minlength: 2,
      },
      email: {
        required: true,
        email: true
      },
      password: {
        required: true,
        minlength: 5
      },
      password_confirmation : {
        required: true,
                    minlength : 5,
                    equalTo : "#password"
                },
      photo:
      {
        required: true,
        extension: "png|jpg|jpeg|PNG|JPEG|JPG|zip",
        filesize: 1048576  
      }

    },
    // Specify validation error messages
    messages: {
      name: {required:"Please enter your firstname",
        minlength:"Your First name must be at least 2 characters long"},
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
      password_confirmation:{
        required: "Please provide a Confirm password",
        minlength: "Your Confirm password must be at least 5 characters long",
        equalTo:"Password Not Matched"
      },
      email: "Please enter a valid email address",
      photo:
      {
        required: "Please Upload Your Profile",
        extension:"Only png,jpg,jpeg,PNG,JPEG,JPG file type is allow",
        filesize:"file must be less than 1 mb"
      }
    },
    
    submitHandler: function(form,e) {
        e.preventDefault(); // avoid submitting the form here
        var formData = new FormData(form);
        $.ajax({
            type:'POST',
            url:$(form).attr('action'),
            data:formData,
            mimeType: "multipart/form-data",
            // enctype: 'multipart/form-data',
            processData: false,  // tell jQuery not to process the data
      contentType: false ,  // tell jQuery not to set contentType
      cache: false,
      async: true,
        timeout: 60000,
            beforeSend:function()
            {
                console.log("beforeSend");
            },
            success:function(data)
            {
               if(data==1)
               {
                 alert("saved Successfully");
               }
               else{
                console.log(data.errors)
               }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                               console.log(jqXHR.responseJSON);
                            }
        })
    //   form.submit();
    }
  });
});
    </script>
  </body>
</html>