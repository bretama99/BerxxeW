<?php
?>
<div class="row">
<h5 style="text-align:center; color: black;"> Available Total Users by Role and Status</h5>
    <div class="col-xs-6">
        <table id="example" class="table table-stripped table-bordered table-hover">
            <thead>
                <tr>
                    <th style="background-color:lightblue;">S/N</th>
                    <th style="background-color:lightblue;">Default Role</th>
                    <th style="background-color:lightblue;">Status</th>
                    <th style="background-color:lightblue;">Total</th>
                </tr>
            </thead>

            <tbody>
            <?php $id=0;
             foreach ($totalUsersWithDefaultRoles as $row) {
                if($row['defaultRole']=="Physician")
                $totalPhyscian+=$row['total'];
                if($row['defaultRole']=="Pharmacist")
                $totalPharmacist+=$row['total'];
                ?>
                <tr>
                    <?php $id = $id + 1; ?>
                    <td><?php echo $id; ?> </td>
                    <td><?php echo $row['defaultRole'];?></td>
                    <td><?php echo $row['status']; ?> </td>
                    <td><?php echo $row['total']; ?> </td>

                </tr>
              <?php }?>
            </tbody>
        </table>
    </div>

    <div class="col-xs-6">
        <table id="example" class="table table-stripped table-bordered table-hover">
            <thead>
                <tr>
                    <th style="background-color:lightblue;">S/N</th>
                    <th style="background-color:lightblue;">Additional Role</th>
                    <th style="background-color:lightblue;">Status</th>
                    <th style="background-color:lightblue;">Total</th>
                </tr>
            </thead>

            <tbody>
            <?php $id=0;
             foreach ($totalUsersWithAdditionalRoles as $row) {
                if($row['additionalRole']=="Physician")
                $totalPhyscian+=$row['total'];
                if($row['additionalRole']=="Pharmacist")
                $totalPharmacist+=$row['total'];
                ?>
                <tr>
                    <?php $id = $id + 1; ?>
                    <td><?php echo $id; ?> </td>
                    <td><?php echo $row['additionalRole'];?></td>
                    <td><?php echo $row['status']; ?> </td>
                    <td><?php echo $row['total']; ?> </td>

                </tr>
              <?php }?>
            </tbody>
        </table>
    </div>


</div>