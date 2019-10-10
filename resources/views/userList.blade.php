<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"></style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

    
</head>
<body>
<h1>Data Table <h1>
<table id="user_rotator_table" class="table display"  width="100%">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
    var link = document.location.origin + "/getData";


    // $.ajax({
    //     type: 'get',
    //     url: link,
    //     success: function (data) {
    //         console.log(data);
    //     },
    //     error: function (data) {
    //         console.log('Unable to save Offer rotator data.');
    //     },
    // });  


var table = '';
table = $('#user_rotator_table').on('processing.dt', function ( e, settings, processing ) {       
            $('#user_rotator_table_performance').css( 'display', processing ? 'block' : 'none' );
        }).DataTable({
            iDisplayLength: 10,
            aLengthMenu: [[10, 50, 100, 200, 500], [10, 50, 100, 200, 500]],
            processing: false,
            serverSide: true,
            language: {
                paginate: {
                  next: '&#8594;', // or '→'
                  previous: '&#8592;' // or '←' 
                }
             },
            
            ajax: {
                url: link
            },
            columns: [              
                {
                    data: 'name',
                    name: 'name',
                    orderable: false,
                },
                {
                    data: 'email',
                    name: 'email',
                    orderable: false,
                },
            ],
        });
</script>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>