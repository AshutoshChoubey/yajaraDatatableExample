<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel DataTables Tutorial</title>

        <!-- Bootstrap CSS -->
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

        <style type="text/css" class="init">
            body {
                        padding-top: 40px;
                }
            td.details-control {
                background: url('https://img.icons8.com/color/32/000000/plus--v2.png') no-repeat center center;
                cursor: pointer;
            }
            tr.shown td.details-control {
                background: url('https://img.icons8.com/flat_round/32/000000/minus.png') no-repeat center center;
            }

            /* .alert-success{ background-color: red;
  color: #2733ce;
  padding: 1em 1.5em;
  text-decoration: none;
  text-transform: uppercase;
} */



    </style>
    </head>
    <body>
        <div class="container">
         
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                    </tr>
                    @foreach($pendingData as $pending)
                    <tr>
                        <td></td>
                        <td>{{ $pending->name}}</td>
                        <td>{{ $pending->email}}</td>
                        <td>Pending</td>
                    </tr>
                    @endforeach
                    <!-- <tr>
                        <td></td>
                        <td>Name</td>
                        <td>Email</td>
                        <td>Status</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Name</td>
                        <td>Email</td>
                        <td>Status</td>
                    </tr> -->
                </thead>
                <tfoot>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <!--<th>Salary</th> -->
                    </tr>
                </tfoot>
            </table>
        </div>
       <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

        <!-- Bootstrap JavaScript -->
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script src="//cdn.datatables.net/plug-ins/1.10.19/sorting/absolute.js"></script>
     <!-- <script type="text/javascript">
        $(function() {
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('datatables.data') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'updated_at', name: 'updated_at' }
                ]
            });
        });
    </script>  -->
    <script type="text/javascript">



        /* Formatting function for row details - modify as you need */
function format ( d ) {
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
    '<tr>'+
            '<td>User Id:</td>'+
            '<td>'+d.id+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Full name:</td>'+
            '<td>'+d.name+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Email:</td>'+
            '<td>'+d.email+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Status:</td>'+
            '<td>This is <b>'+d.status+'</b> user</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Users Created Date:</td>'+
            '<td>This User '+d.created_at+'</td>'+
        '</tr>'+
    '</table>'; 
}
 
$(document).ready(function() {
    var nameType = $.fn.dataTable.absoluteOrder( 'Pending' );
    var table = $('#example').DataTable( 
        {
        rowGroup: {
        dataSrc: 'status'
    },
    columnDefs: [
        { targets: 0, type: nameType }
    ],
        "iDisplayLength": 10,
        orderCellsTop: true,
        "processing": false,
        "serverSide": true,
        "ajax": "http://127.0.0.1:8000/user",
        "columns": [
            {
                "className":      'details-control',
                "orderable":      false,
                "searchable":     false,
                "data":           null,
                "defaultContent": ''
            },
            { "data": "name" },
            { "data": "email" },
            { "data": "status" ,
                "createdCell": function (td, cellData, rowData, row, col) {
                            if (cellData =='Active') {
                                $(td).addClass('alert-success');
                                $(td).addClass('sorting_1');
                                
                            }
                            if (cellData =='Inactive'){
                                $(td).addClass('text-danger');
                                $(td).addClass('sorting_1');
                            }
                            if (cellData =='Pending'){
                                $(td).addClass('text-warning');
                                $(td).addClass('sorting_1');
                            }
                    }
            },
            // { "data": "salary" }
        ],
        "order": [[1, 'asc']]
    } );
    $('#myTable').DataTable( {
    columnDefs: [
        { targets: 0, type: nameType }
    ]
} );
     
    // Add event listener for opening and closing details
    $('#example tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    } );
} );









         // $(function() {
        // var template = Handlebars.compile($("#details-template").html());
        // var table = $('#users-table').DataTable({
        //     processing: true,
        //     serverSide: true,
        //      ajax: 'http://127.0.0.1:8000/user',
        //     columns: [
        //         {
        //             "className":      'details-control',
        //             "orderable":      false,
        //             "searchable":      false,
        //             "data":           null,
        //             "defaultContent": ''
        //         },
        //         {data: 'id', name: 'id'},
        //         {data: 'name', name: 'name'},
        //         {data: 'email', name: 'email'},
        //         {data: 'created_at', name: 'created_at'},
        //         {data: 'updated_at', name: 'updated_at'}
        //     ],
        //     order: [[1, 'asc']]
        // });

        // Add event listener for opening and closing details
        // $('#users-table tbody').on('click', 'td.details-control', function () {
        //     var tr = $(this).closest('tr');
        //     var row = table.row(tr);
        //     var tableId = 'posts-' + row.data().id;

        //     if (row.child.isShown()) {
        //         // This row is already open - close it
        //         row.child.hide();
        //         tr.removeClass('shown');
        //     } else {
        //         // Open this row
        //         row.child(template(row.data())).show();
        //         initTable(tableId, row.data());
        //         tr.addClass('shown');
        //         tr.next().find('td').addClass('no-padding bg-gray');
        //     }
        // });

        // function initTable(tableId, data) {
        //     $('#' + tableId).DataTable({
        //         processing: true,
        //         serverSide: true,
        //         ajax: data.details_url,
        //         columns: [
        //             { data: 'id', name: 'id' },
        //             { data: 'title', name: 'title' }
        //         ]
        //     })
        // }
    




         /* Formatting function for row details - modify as you need */
// function format ( d ) {
//     // `d` is the original data object for the row
//     return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
//         '<tr>'+
//             '<td>Full name:</td>'+
//             '<td>'+d.name+'</td>'+
//         '</tr>'+
//         '<tr>'+
//             '<td>Extension number:</td>'+
//             '<td>'+d.extn+'</td>'+
//         '</tr>'+
//         '<tr>'+
//             '<td>Extra info:</td>'+
//             '<td>And any further details here (images etc)...</td>'+
//         '</tr>'+
//     '</table>';
// }
 
// $(document).ready(function() {
//     var table = $('#example').DataTable( {
//         "ajax": "../ajax/data/objects.txt",
//         "columns": [
//             {
//                 "className":      'details-control',
//                 "orderable":      false,
//                 "data":           null,
//                 "defaultContent": ''
//             },
//             { "data": "name" },
//             { "data": "position" },
//             { "data": "office" },
//             { "data": "salary" }
//         ],
//         "order": [[1, 'asc']]
//     } );
     
    // Add event listener for opening and closing details
//    $('#users-table tbody').on('click', 'td.details-control', function () {
//         var row = $(this).closest('tr');
 
//         if ( row.child.isShown() ) {
//             // This row is already open - close it
//             row.child.hide();
//             tr.removeClass('shown');
//         }
//         else {
//             // Open this row
//             row.child( format(row.data()) ).show();
//             tr.addClass('shown');
//         }
//     } );
// } );
    </script>
    

</html>