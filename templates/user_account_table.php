<!-- DataTables Example -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

<?php
$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($db->connect_errno) {
  die("Unable to Connect");
}
$sql = "SELECT * FROM account a JOIN users u where u.id = $u_id AND a.user_name = u.user_name";
$result = $db->query($sql);
?>

<div class="card mb-3">
  <div class="card-header">
    <div class="h5">Account Report</div>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

        <tr>
          <th>Name</th>
          <th>Rent</th>
          <th>Bill</th>
          <th>Food</th>
          <th>Other</th>
          <th>Total</th>
          <th>Deposit</th>
          <th>Net Balance</th>
        </tr>
        <?php

        while ($account_data = mysqli_fetch_assoc($result)) {
          ?>

          <tr>
            <td><?php echo $account_data['full_name']; ?></td>
            <td><?php echo $account_data['rent']; ?></td>
            <td><?php echo $account_data['bill']; ?></td>
            <td><?php echo $account_data['food']; ?></td>
            <td><?php echo $account_data['other']; ?></td>
            <td><?php echo $account_data['total']; ?></td>
            <td><?php echo $account_data['deposit']; ?></td>
            <td><?php echo $account_data['net_balance']; ?></td>

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

    <form action="templates/export.php" method="post">
      <input class="btn btn-primary btn-block" type="submit" name="export" value="Export" style="margin-top:30px">
    </form>

  </div>
</div>