<!-- DataTables Example -->
<?php
$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($db->connect_errno) {
  die("Unable to Connect");
}
$sql = "SELECT * FROM feedback";
$result = $db->query($sql);


?>

<div class="card mb-3">
  <div class="card-header">
    <div class="h5">User Report</div>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

        <tr>
          <th>Name</th>
          <th>Phone No.</th>
          <th>Comment</th>
          <th>Date</th>
          <th>Time</th>
          <th>Action</th>

        </tr>
        <?php
        while ($user_data = mysqli_fetch_assoc($result)) {
          ?>

          <tr>
            <td><?php echo $user_data['full_name']; ?></td>
            <td><?php echo $user_data['phone']; ?></td>
            <td><?php echo $user_data['comment']; ?></td>
            <td><?php echo $user_data['date']; ?></td>
            <td><?php echo $user_data['time']; ?></td>
            <td>
              <div class="container">
                <a href="templates/delete_feedback.php?del=<?php echo $user_data['id']; ?> ">
                  <button type="button" class="btn btn-danger" value="del">
                    Delete</button></a>
            </td>

          </tr>
        <?php
      }
      ?>

      </table>
    </div>
  </div>


  <div class="card-footer small text-muted">Updated at
    <?php

    echo date(" d/m/Y ") . "  " . date(" h:i:s a ");
    ?>

  </div>
</div>
