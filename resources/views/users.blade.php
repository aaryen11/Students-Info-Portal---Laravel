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
                <th>CGPA</th>
                <th>12th %</th>
                <th>10th %</th>
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

<div id="formModal" class="modal fade" role="dialog">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Record</h4>
        </div>
        <div class="modal-body">
         <span id="form_result"></span>
         <form method="post" id="sample_form" class="form-horizontal">
          @csrf
          <div class="form-group">
            <label class="control-label col-md-4" >Name : </label>
            <div class="col-md-8">
             <input type="text" name="name" id="name" class="form-control" />
            </div>
           </div>
           <div class="form-group">
            <label class="control-label col-md-4">Email : </label>
            <div class="col-md-8">
             <input type="text" name="email" id="email" class="form-control" />
            </div>
            </div>
            <div class="form-group">
            <label class="control-label col-md-4">Official Email : </label>
            <div class="col-md-8">
             <input type="text" name="oemail" id="oemail" class="form-control" />
            </div>
            </div>
            <div class="form-group">
            <label class="control-label col-md-4">CGPA : </label>
            <div class="col-md-8">
             <input type="text" name="cgpa" id="cgpa" class="form-control" />
            </div>
            </div>
            <div class="form-group">
            <label class="control-label col-md-4">12th % : </label>
            <div class="col-md-8">
             <input type="text" name="12th" id="12th" class="form-control" />
            </div>
           </div>
           <div class="form-group">
            <label class="control-label col-md-4">10th % : </label>
            <div class="col-md-8">
             <input type="text" name="10th" id="10th" class="form-control" />
            </div>
           </div>

           <div class="form-group">
            <label class="control-label col-md-4">Contact No. : </label>
            <div class="col-md-8">
             <input type="text" name="phone" id="phone" class="form-control" />
            </div>
           </div>


           <div class="form-group">
            <label class="control-label col-md-4">Course : </label>
            <div class="col-md-8">
             <input type="text" name="course" id="course" class="form-control" />
            </div>
           </div>


           <div class="form-group">
            <label class="control-label col-md-4">Branch : </label>
            <div class="col-md-8">
             <input type="text" name="branch" id="branch" class="form-control" />
            </div>
           </div>


           <div class="form-group">
            <label class="control-label col-md-4">Section : </label>
            <div class="col-md-8">
             <input type="text" name="section" id="section" class="form-control" />
            </div>
           </div>


           <div class="form-group">
            <label class="control-label col-md-4">Group : </label>
            <div class="col-md-8">
             <input type="text" name="group" id="group" class="form-control" />
            </div>
           </div>


           <div class="form-group">
            <label class="control-label col-md-4">University : </label>
            <div class="col-md-8">
             <input type="text" name="university" id="university" class="form-control" />
            </div>
           </div>
                <br />
                <div class="form-group" align="center">
                 <input type="hidden" name="action" id="action" value="Add" />
                 <input type="hidden" name="hidden_id" id="hidden_id" />
                 <input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="Add" />
                </div>
         </form>
        </div>
     </div>
    </div>
</div>

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
            {data: 'CGPA', name: 'CGPA'},
            {data: 'XII', name: 'XII'},
            {data: 'X', name: 'X'},
            {data: 'phone', name: 'phone'},
            {data: 'course', name: 'course'},
            {data: 'branch', name: 'branch'},
            {data: 'section', name: 'section'},
            {data: 'group', name: 'group'},
            {data: 'university', name: 'university'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
  ]
 });

 $('#sample_form').on('submit', function(event){
  event.preventDefault();
  var action_url = "{{ route('user.update') }}";

  $.ajax({
   url: action_url,
   method:"POST",
   data:$(this).serialize(),
   dataType:"json",
   success:function(data)
   {
    var html = '';
    if(data.errors)
    {
     html = '<div class="alert alert-danger">';
     for(var count = 0; count < data.errors.length; count++)
     {
      html += '<p>' + data.errors[count] + '</p>';
     }
     html += '</div>';
    }
    if(data.success)
    {
     html = '<div class="alert alert-success">' + data.success + '</div>';
     $('#user_table').DataTable().ajax.reload();
    }
    $('#form_result').html(html);
   }
  });
 });




 $(document).on('click', '.edit', function(){
  var id = $(this).attr('id');
  $('#form_result').html('');
  $.ajax({
   url :"users/edit/"+id,
   dataType:"json",
   success:function(data)
   {
    $('#name').val(data.result.name);
    $('#email').val(data.result.email);
    $('#oemail').val(data.result.official_email_id);
    $('#cgpa').val(data.result.CGPA);
    $('#12th').val(data.result.XII);
    $('#10th').val(data.result.X);
    $('#phone').val(data.result.phone);
    $('#course').val(data.result.course);
    $('#branch').val(data.result.branch);
    $('#section').val(data.result.section);
    $('#group').val(data.result.group);
    $('#university').val(data.result.university);
    $('#hidden_id').val(id);
    $('.modal-title').text('Edit Record');
    $('#action_button').val('Edit');
    $('#action').val('Edit');
    $('#formModal').modal('show');
   }
  })
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
   success:function()
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

