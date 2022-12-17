<!DOCTYPE html>
<html>

<head>
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?php echo e(asset('todo.css')); ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" />
  <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<body>
  <div id="myDIV" class="header">
    <h3>My To Do List</h3>
    <button type="submit" class="btn btn-primary savve-btn">Add Task</button>
  </div>
  <div class="container mt-5">
    <table class="table table-bordered yajra-datatable">
      <thead>
        <tr>
          <th>S.No</th>
          <th>List</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
 <!-- Modal start -->
  <div class="modal" id="editmodal">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 id="addtask">Add Task</h4>
          <h4 id="updatetask">Update Task</h4>
          <button type="submit" class="btn btn-danger abs updateclosebtn">x</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
          <div class="alert alert-success" id="success"><strong>Success!</strong></div>
          <form name="todoupdateForm" id="todoupdateForm" method="post" action="javascript:void(0)">
            <?php echo csrf_field(); ?>
            <input type="hidden" id="list_id" name="list_id" value="" />
            <div class="form-group">
              <label for="name" id="label_add">Add Task Here..</label>
              <label for="name" id="label_update">Update Task Here..</label>
              <textarea class="form-control" name="list" id="listtttt1" rows="3" placeholder="enter task here..."
                autofocus></textarea>
            </div>
            <div></div>
            <button type="submit" id="updatebtnn" class="btn btn-success updatebtn">UPDATE</button>
            <button type="submit" id="addbtn" class="btn btn-success save-btn">ADD</button>
          </form>
        </div>
        <!-- Modal footer -->
      </div>
    </div>
  </div>
  <!-- Modal end -->
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
  $(document).ready(function () {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    var table = $('.yajra-datatable').DataTable({
      processing: true,
      serverSide: true,
      ajax: "<?php echo e(route('display')); ?>",
      columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'list', list: 'list' },
        {
          data: 'action',
          name: 'action',
          orderable: true,
          searchable: true
        },

      ]
    });



    $(".updateclosebtn").click(function () {
      $("#todoupdateForm")[0].reset();
      $('#editmodal').hide();
    });

    $(".savve-btn").click(function () {
      $("#todoupdateForm")[0].reset();
      $('#listtttt1').text('')
      $('#editmodal').show();
      $("#updatebtnn").hide();
      $("#addbtn").show();
      $("#updatetask").hide();
      $("#label_update").hide();
      $("#label_add").show();
      $("#addtask").show();

    });
    $(".save-btn").click(function () {
      $.ajax({
        url: "<?php echo e(url('save-data')); ?>",
        type: "POST",
        data: $('#todoupdateForm').serialize(),
        success: function (response) {
          $('#success').show().delay(1000).fadeOut();
          $("#todoupdateForm")[0].reset();
          $("#editmodal").delay(1000).fadeOut('slow');
          $('.yajra-datatable').DataTable().ajax.reload();

        }
      });
    });
    $(document).on('click', '.updatebtn', function (event) {
      $('#editmodal').show();
      $.ajax({
        url: "<?php echo e(url('update-list')); ?>",
        type: "POST",
        data: $('#todoupdateForm').serialize(),
        success: function (response) {
          $('#success').show().delay(1000).fadeOut();
          $('#listtttt1').text('')
          $("#editmodal").delay(1000).fadeOut('slow');
          $('.yajra-datatable').DataTable().ajax.reload();
        }
      });
    });
    $(document).on('click', '.edit', function (event) {
      event.preventDefault();
      var id = $(this).attr('id');
      $('#editmodal').show();
      $("#addbtn").hide();
      $("#updatebtnn").show();
      $("#updatetask").show();
      $("#addtask").hide();
      $("#label_update").show();
      $("#label_add").hide();
      $.ajax({
        type: "GET",
        url: "/edit-list/" + id,
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function (response) {
          $('#listtttt1').text(response.todolist.list);
          $('#list_id').val(id);
           var input = $("#listtttt1");
           var tmp = input.val();
           input.focus().val("").blur().focus().val(tmp);

        }

      });
    });
    var user_id;
    $(document).on('click', '.delete', function () {
      if (confirm("Are you sure want to delete??") == true) {
        user_id = $(this).attr('id');
        $.ajax({
          type: "GET",
          url: "/delete-list/" + user_id,
          success: function (response) {
            $('.yajra-datatable').DataTable().ajax.reload();
          }
        });

      }



    });

  });
</script>

</html>
<?php /**PATH /home/vyrazu-06/Desktop/todo/resources/views/display.blade.php ENDPATH**/ ?>