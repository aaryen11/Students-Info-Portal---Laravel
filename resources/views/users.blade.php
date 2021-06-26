<html>
 <head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Student Records</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 </head>
 <body>
  <div style="margin-left:2%;margin-right:2%;">    
     <br />
     <h3 align="center">Student Records</h3>
     <br />
   <div class="table-responsive">
    <table id="user_table" class="table table-bordered table-striped">
    <a href="/home"><button style="margin-bottom: 10px; margin-right:20% float:right;" class="btn btn-primary">< Home</button></a>
     <thead>
      <tr>
      <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Official Email</th>
                <th>Contact No.</th>
                <th>Course</th>
                <th>Branch</th>
                <th>Section</th>
                <th>Group</th>
                <th>University</th>
                <th width="100px">Action</th>
        </tr>
     </thead>
    </table>
   </div>
   <br />
   <br />
  </div>
 </body>
</html>

<div id="confirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="modal-title">Confirmation</h2>
            </div>
            <div class="modal-body">
                <h4 align="center" style="margin:0;">Are you sure you want to remove this data?</h4>
            </div>
            <div class="modal-footer">
             <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>


<script>
$(document).ready(function(){

 $('#user_table').DataTable({
  processing: true,
  serverSide: true,
  ajax: {
   url: "{{ route('users.usertable') }}",
  },
  columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'official_email_id', name: 'official_email_id'},
            {data: 'phone', name: 'phone'},
            {data: 'course', name: 'course'},
            {data: 'branch', name: 'branch'},
            {data: 'section', name: 'section'},
            {data: 'group', name: 'group'},
            {data: 'university', name: 'university'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
  ]
 });

 var user_id;

 $(document).on('click', '.delete', function(){
  user_id = $(this).attr('id');
  $('#confirmModal').modal('show');
 });

 $('#ok_button').click(function(){
  $.ajax({
   url: 'users/'+user_id,
   beforeSend:function(){
    $('#ok_button').text('Deleting...');
   },
   success:function(data)
   {
    setTimeout(function(){
     $('#confirmModal').modal('hide');
     $('#user_table').DataTable().ajax.reload();
     alert('Data Deleted');
    }, 2000);
   }
  })
 });

});
</script>

