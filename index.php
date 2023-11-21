<?php include('connection.php'); ?>

<?php 
session_start();
if(!isset($_SESSION["user"])){
  header("Location: login.php");
  exit();
}
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="css/bootstrap5.0.1.min.css" rel="stylesheet" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/datatables-1.10.25.min.css" />
  
  <title>Raee</title>
  <style type="text/css">
    .btnAdd {
      text-align: right;
      width: 83%;
      margin-bottom: 20px;
    }
  </style>
</head>

<body>
  <div class="container-fluid">
    <a href="https://alraee.com.sa/"><img src="alraee.webp" alt="HTML tutorial" style="width:120px;height:70px;"></a>
    <p class="datatable design text-left">CRM BETA</p>
    <div class="row">
      <div class="container">
        <div class="btnAdd">
          <a href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#addUserModal" class="btn btn-success btn-sm">Add User</a>
        </div>
        <div class="row">
          <div class="col-md-1"></div>
          <div class="col-md-10">
            <table id="example" class="table">
              <thead>
                <th>ID</th>
                <th>Status</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Comment</th>
                <th>Options</th>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
          <div class="col-md-1"></div>
        </div>
      </div>
    </div>
  </div>
  <!-- Optional JavaScript; choose one of the two! -->
  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
  <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/dt-1.10.25datatables.min.js"></script>
  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
  -->
  <script type="text/javascript">
    $(document).ready(function() {
      $('#example').DataTable({
        "fnCreatedRow": function(nRow, aData, iDataIndex) {
          $(nRow).attr('id', aData[0]);
        },
        'serverSide': 'true',
        'processing': 'true',
        'paging': 'true',
        'order': [],
        'ajax': {
          'url': 'fetch_data.php',
          'type': 'post',
        },
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": [5]
          },

        ]
      });
    });
    $(document).on('submit', '#addUser', function(e) {
      e.preventDefault();
      var st_id = $('#addst_idField').val();
      var username = $('#addUserField').val();
      var email = $('#addEmailField').val();
      var mobile = $('#addMobileField').val();
      var industry = $('#addIndustryField').val();
      var yr_id = $('#addYr_idField').val();
      var comment = $('#addCommentField').val();
      if (industry != '' && st_id != '' && comment != '' && username != '' && mobile != '' && email != '') {
        $.ajax({
          url: "add_user.php",
          type: "post",
          data: {
            st_id: st_id,
            username: username,
            email: email,
            mobile: mobile,
            industry: industry,
            comment: comment
          },
          success: function(data) {
            var json = JSON.parse(data);
            var status = json.status;
            if (status == 'true') {
              mytable = $('#example').DataTable();
              mytable.draw();
              $('#addUserModal').modal('hide');
            } else {
              alert('failed');
            }
          }
        });
      } else {
        alert('Fill all the required fields');
      }
    });
    $(document).on('submit', '#updateUser', function(e) {
      e.preventDefault();
      //var tr = $(this).closest('tr');
      var industry = $('#industryField').val();
      var comment = $('#commentField').val();
      var st_id = $('#st_idField').val();
      var username = $('#nameField').val();
      var mobile = $('#mobileField').val();
      var email = $('#emailField').val();
      var trid = $('#trid').val();
      var id = $('#id').val();
      if (industry != '' && comment != '' && st_id != '' && username != '' && mobile != '' && email != '') {
        $.ajax({
          url: "update_user.php",
          type: "post",
          data: {
            industry: industry,
            comment: comment,
            st_id: st_id,
            username: username,
            mobile: mobile,
            email: email,
            id: id
          },
          success: function(data) {
            var json = JSON.parse(data);
            var status = json.status;
            if (status == 'true') {
              table = $('#example').DataTable();
              // table.cell(parseInt(trid) - 1,0).data(id);
              // table.cell(parseInt(trid) - 1,1).data(st_id);
              // table.cell(parseInt(trid) - 1,2).data(username);
              // table.cell(parseInt(trid) - 1,3).data(email);
              // table.cell(parseInt(trid) - 1,4).data(mobile);
              // table.cell(parseInt(trid) - 1,5).data(industry);
              // table.cell(parseInt(trid) - 1,6).data(comment);
              var button = '<td><a href="javascript:void();" data-id="' + id + '" class="btn btn-info btn-sm editbtn">Edit</a></td>';
              var row = table.row("[id='" + trid + "']");
              row.row("[id='" + trid + "']").data([id, st_id, username, email, mobile, comment, button]);
              $('#exampleModal').modal('hide');
            } else {
              alert('failed');
            }
          } 
        });
      } else {
        alert('Fill all the required fields');
      }
    });
    $('#example').on('click', '.editbtn ', function(event) {
      var table = $('#example').DataTable();
      var trid = $(this).closest('tr').attr('id');
      // console.log(selectedRow);
      var id = $(this).data('id');
      $('#exampleModal').modal('show');

      $.ajax({
        url: "get_single_data.php",
        data: {
          id: id
        },
        type: 'post',
        success: function(data) {
          var json = JSON.parse(data);
          $('#st_idField').val(json.st_id);
          $('#nameField').val(json.username);
          $('#emailField').val(json.email);
          $('#mobileField').val(json.mobile);
          $('#industryField').val(json.industry);
          $('#commentField').val(json.comment);
          $('#id').val(id);
          $('#trid').val(trid);
        }
      })
    });

  </script>
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="updateUser">
            <input type="hidden" name="id" id="id" value="">
            <input type="hidden" name="trid" id="trid" value="">
            <div class="mb-3 row">
              <label for="st_idField" class="col-md-3 form-label">Status</label>
              <div class="col-md-9">
              <select id="st_idField" 
                    class="form-control">
                      <option>Pending</option>
                      <option>Customer Pending</option>
                      <option>Call Back</option>
                      <option>Resolve- With Business</option>
                      <option>Resolve- Without Business</option>
                  </select>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="commentField" class="col-md-3 form-label">Comment</label>
              <div class="col-md-9">
                <textarea id="commentField" rows="5" class="form-control block" placeholder="Leave a comment..."></textarea>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="nameField" class="col-md-3 form-label">Name</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="nameField" name="name">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="emailField" class="col-md-3 form-label">Email</label>
              <div class="col-md-9">
                <input type="email" class="form-control" id="emailField" name="email">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="mobileField" class="col-md-3 form-label">Mobile</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="mobileField" name="mobile">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="industryField" class="col-md-3 form-label">Industry</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="industryField" name="Industry">
              </div>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Add user Modal -->
  <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="addUser" action="">
            <div class="mb-3 row">
              <label for="addUserField" class="col-md-3 form-label">Name</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="addUserField" name="name">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="addEmailField" class="col-md-3 form-label">Email</label>
              <div class="col-md-9">
                <input type="email" class="form-control" id="addEmailField" name="email">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="addMobileField" class="col-md-3 form-label">Mobile</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="addMobileField" name="mobile">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="addIndustryField" class="col-md-3 form-label">Industry</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="addIndustryField" name="Industry" placeholder="Your Comapny Detail...">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="addCommentField" class="col-md-3 form-label">Comment</label>
              <div class="col-md-9">
                <textarea id="commentField" rows="5" class="form-control block" placeholder="Leave a comment..."></textarea>
              </div>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
<script type="text/javascript">
  //var table = $('#example').DataTable();
</script>