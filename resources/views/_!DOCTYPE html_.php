<!DOCTYPE html>
<html>
<head>
<meta name="csrf-token" content = "{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  margin: 0;
  min-width: 250px;
}

/* Include the padding and border in an element's total width and height */
* {
  box-sizing: border-box;
}

/* Remove margins and padding from the list */
ul {
  margin: 0;
  padding: 0;
}

/* Style the list items */
ul li {
  cursor: pointer;
  position: relative;
  padding: 12px 8px 12px 40px;
  list-style-type: none;
  background: #eee;
  font-size: 18px;
  transition: 0.2s;
  
  /* make the list items unselectable */
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Set all odd list items to a different color (zebra-stripes) */
ul li:nth-child(odd) {
  background: #f9f9f9;
}

/* Darker background-color on hover */
ul li:hover {
  background: #ddd;
}

/* When clicked on, add a background color and strike out text */
ul li.checked {
  background: #888;
  color: #fff;
  text-decoration: line-through;
}

/* Add a "checked" mark when clicked on */
ul li.checked::before {
  content: '';
  position: absolute;
  border-color: #fff;
  border-style: solid;
  border-width: 0 2px 2px 0;
  top: 10px;
  left: 16px;
  transform: rotate(45deg);
  height: 15px;
  width: 7px;
}

/* Style the close button */
.close {
  position: absolute;
  right: 0;
  top: 0;
  padding: 12px 16px 12px 16px;
}

.close:hover {
  background-color: #f44336;
  color: white;
}

/* Style the header */
.header {
  background-color: #f44336;
  padding: 30px 40px;
  color: white;
  text-align: center;
}

/* Clear floats after the header */
.header:after {
  content: "";
  display: table;
  clear: both;
}

/* Style the input */
input {
  margin: 0;
  border: none;
  border-radius: 0;
  width: 75%;
  padding: 10px;
  float: left;
  font-size: 16px;
}
.btn-success {
    color: #fff;
    background-color: #28a745;
    border-color: #28a745;
    margin-top: 25px;
    float:right;
}
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

 td ,th{
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
  text-align: center !important;
} 

tr:nth-child(even) {
  background-color: #dddddd;
}
.btn-primary {
    margin-bottom: 25px;
}
.fa {
	
    padding: 8px;
}
.fa-envelope:before, .fa-map-marker:before, .fa-phone:before {
    padding: inherit;
}
.btn-primary {
    color: #fff;
    background-color: #007bff;
    border-color: #007bff;
    margin-top: 10px;
    float: right;
}
button {
  all: unset;
  cursor: pointer;
}

button:focus {
  outline: orange 5px auto;
}
li {
    width: max-content;
}

</style>
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.20.0/ckeditor.js"></script>
</head> 
<body>

<div id="myDIV" class="header">

<form name="todoForm" id="todoForm" method="post" action="javascript:void(0)">
  @csrf
  <h2 style="margin:5px">My To Do List</h2>
  <!-- <input type="hidden" class="form-control" placeholder="Enter name" name="name" value="avinash"> -->
   <!-- <textarea name="list" id="list">&lt;p&gt;Initial editor content.&lt;/p&gt;</textarea>
            <script>
                CKEDITOR.replace( 'list' );
            </script>   -->
    <textarea class = "form-control"  name="list" id="list" rows = "3" placeholder = "Enter list"></textarea>  

  <!-- <input type="text" class="form-control" id="list" placeholder="Enter List" name="list">  -->
  <!-- <br> -->
  <button type="submit" class="btn btn-primary save-btn" id="submit">Submit</button> 
</form>

</div>
@if ($message = Session::get('statuss'))
<div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>    
    <strong>{{ $message }}</strong>

</div>
@endif
@if ($message = Session::get('update'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>    
            <strong>{{ $message }}</strong>

        </div>
@endif
<table class="display" style="width: 100%">
      <thead>
        <tr>
          <th>Sl.No</th>
          <th>List</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="example">
      @foreach ($todolist as $item)

        <tr>
          <td>{{$item->id}}</td>
            <td>{!! html_entity_decode($item->list) !!}</td>
            <td><button type="button" value="{{$item->id}}" class="fa fa-trash delete-btn" aria-hidden="true" style="color: red;"></button>
            <button type="button" value="{{$item->id}}" class="fa fa-edit edit-btn" aria-hidden="true"></button>
        </tr>
          @endforeach
      </tbody>
    </table>
    <div class="modal" id="editmodal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit details</h4>
          <a href="#" class="close" data-dismiss="editmodal" aria-label="close">&times;</a>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        
          
          <form name="todoFormm" id="todoFormm" method="post" action="javascript:void(0)">
          	@csrf
          	<input type="hidden" id="list_id" name="list_id" value=""/>
			  <div class="form-group">
			    <label for="name">List</label>
                
                <textarea class = "form-control"  name="list" id="list1" rows = "3" placeholder = "Update your list"></textarea>
					
			  </div>
              <div></div>
              <button type="submit" class="btn btn-primary savve-btn" id="submit">Submit</button> 
			  
			</form>
        </div>
        
        <!-- Modal footer -->
        
      </div>
    </div>
  </div>


</body>
</html>
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
      $.ajaxSetup({
      headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".savve-btn").click(function(){
  		$.ajax({
        url: "{{url('update-list')}}",
        type: "POST",
        data: $('#todoFormm').serialize(),
           success: function( response ) {
            if (response) {
              location.reload();
        }
           }
       });
  });

      $(".save-btn").click(function(){
  		$.ajax({
        url: "{{url('save-data')}}",
        type: "POST",
        data: $('#todoForm').serialize(),
           success: function( response ) {
            if (response) {
              location.reload();
        }
           }
       });
  });
    $(".edit-btn").click(function(){
  		var id= $(this).val();
  		$('#editmodal').show();

  		$.ajax({
           type: "GET",
           url: "/edit-list/"+id,
           success: function( response ) {
   				
              $('#list1').text(response.todolist.list);
              
              $('#list_id').val(id);
           }
       });
  });


  $(".delete-btn").click(function(){
  	if (confirm("Are you sure want to delete??") == true) {
  	var id= $(this).val();
  	$.ajax({
           type: "GET",
           url: "/delete-list/"+id,
           success: function( response ) {
   				
              window.location.reload();
           }
       });
  }

 });
});
</script>