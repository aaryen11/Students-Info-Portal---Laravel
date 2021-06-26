<!DOCTYPE html>
<html>
<head>
    <title>Student Records</title>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-confirmation/1.0.5/bootstrap-confirmation.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">


</head>
<body>
<div class="container">
    <h3>Student Records</h3>
    <button style="margin-bottom: 10px" class="btn btn-primary delete_all" data-url="{{ url('userDeleteAll') }}">Delete All Selected</button>
    <a href="/home"><button style="margin-bottom: 10px; float:right;" class="btn btn-primary">< Home</button></a>
    <table class="table table-bordered">
        <tr>
            <th width="50px"><input type="checkbox" id="master"></th>
            <th width="80px">No</th>
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
        @if($users->count())
            @foreach($users as $key => $record)
                <tr id="tr_{{$record->id}}">
                @if($record->usertype=='1')
                    <td><input type="checkbox" disabled></td>
                @else
                    <td><input type="checkbox" class="sub_chk" data-id="{{$record->id}}"></td>
                @endif
                    <td>{{ ++$key }}</td>
                    <td>{{ $record->name }}</td>
                    <td>{{ $record->email }}</td>
                    <td>{{ $record->official_email_id }}</td>
                    <td>{{ $record->phone }}</td>
                    <td>{{ $record->course }}</td>
                    <td>{{ $record->branch }}</td>
                    <td>{{ $record->section }}</td>
                    <td>{{ $record->group }}</td>
                    <td>{{ $record->university }}</td>
                    <td>
                         <a href="{{ url('delete',$record->id) }}" class="btn btn-danger btn-sm"
                           data-tr="tr_{{$record->id}}"
                           data-toggle="confirmation"
                           data-btn-ok-label="Delete" data-btn-ok-icon="fa fa-remove"
                           data-btn-ok-class="btn btn-sm btn-danger"
                           data-btn-cancel-label="Cancel"
                           data-btn-cancel-icon="fa fa-chevron-circle-left"
                           data-btn-cancel-class="btn btn-sm btn-default"
                           data-title="Are you sure you want to delete ?"
                           data-placement="left" data-singleton="true">
                            Delete
                        </a>
                    </td>
                </tr>
            @endforeach
        @endif
    </table>
    {{$users->links()}}
</div> <!-- container / end -->
<center><a href="/home"><button style="margin-bottom: 10px;" class="btn btn-primary">< Home</button></a></center>

</body>

<script type="text/javascript">
    $(document).ready(function () {


        $('#master').on('click', function(e) {
         if($(this).is(':checked',true))  
         {
            $(".sub_chk").prop('checked', true);  
         } else {  
            $(".sub_chk").prop('checked',false);  
         }  
        });


        $('.delete_all').on('click', function(e) {


            var allVals = [];  
            $(".sub_chk:checked").each(function() {  
                allVals.push($(this).attr('data-id'));
            });  


            if(allVals.length <=0)  
            {  
                alert("Please select row.");  
            }  else {  


                var check = confirm("Are you sure you want to delete this row?");  
                if(check == true){  


                    var join_selected_values = allVals.join(","); 


                    $.ajax({
                        url: $(this).data('url'),
                        type: 'DELETE',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: 'ids='+join_selected_values,
                        success: function (data) {
                            if (data['success']) {
                                $(".sub_chk:checked").each(function() {  
                                    $(this).parents("tr").remove();
                                });
                                alert(data['success']);
                            } else if (data['error']) {
                                alert(data['error']);
                            } else {
                                alert('Whoops Something went wrong!!');
                            }
                        },
                        error: function (data) {
                            alert(data.responseText);
                        }
                    });


                  $.each(allVals, function( index, value ) {
                      $('table tr').filter("[data-row-id='" + value + "']").remove();
                  });
                }  
            }  
        });


        $('[data-toggle=confirmation]').confirmation({
            rootSelector: '[data-toggle=confirmation]',
            onConfirm: function (event, element) {
                element.trigger('confirm');
            }
        });


        $(document).on('confirm', function (e) {
            var ele = e.target;
            e.preventDefault();


            $.ajax({
                url: ele.href,
                type: 'DELETE',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    if (data['success']) {
                        $("#" + data['tr']).slideUp("slow");
                        alert(data['success']);
                    } else if (data['error']) {
                        alert(data['error']);
                    } else {
                        alert('Whoops Something went wrong!!');
                    }
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });


            return false;
        });
    });
</script>
</html>

