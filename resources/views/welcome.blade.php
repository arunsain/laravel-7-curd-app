<!DOCTYPE html>
<html lang="en">
<head>
  <title>Task</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <br>
  <br>
  @if(session()->has('success'))

            <div class="alert alert-success">
                <strong>Success!</strong> {{ session()->get('success') }}.
            </div>

            @endif
  <h2>User List</h2> <a href="{{ route('add.user') }}" class="btn btn-primary">Add User</a>
            
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Class</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach($user as $users)
      <tr>
        <td>{{ $users->name }}</td>
        <td>{{ $users->email }}</td>
        <td>{{ $users->phone_no }}</td>
        <td>{{ $users->classData->class_name }}</td>
        <td><a href="{{ route('edit.user',$users->id) }}" class="btn btn-success btn-sm">edit</a> <button type="button" data-id="{{ $users->id }}" class="btn btn-danger btn-sm deleteData">delete</button></td>
      </tr>
       @endforeach
    </tbody>
  </table>
</div>

<script>

  $('.deleteData').click(function(){
    var id = $(this).data('id');
      //alert(id);

  if (confirm("Are you want to delete User") == true) {
    
 


       $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

        $.ajax({
           type:'post',
           url:"{{ route('delete.user') }}",
           data:{id:id},
           success:function(data){
           //  alert(data+"arun");
             location.reload();

             // $("#dynamicTimeTable").html(data);
           }
        });

         } else {
    return false;
  }
       
    });

 </script>

</body>
</html>
