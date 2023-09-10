<?php
?>
<div class="row">
    <h5 style="text-align:center;"> List of Total Pharmacies Available in the system (Summary) ..</h5>
    <div class="col-xs-12">
        <table id="example" class="table table-stripped table-bordered table-hover">
            <thead>
                <tr>
                    <th>S/N</th>
                    <th>State</th>
                    <th>Category</th>
                    <th>Approval</th>
                    <th>Open</th>
                    <th>Total</th>
                </tr>
            </thead>

            <tbody>
            <?php $id=0; foreach ($totalPharmacies as $row) {
                 $totalAllPharmacy+=$row['total'];?>
                <tr>
                    <?php $id = $id + 1; ?>
                    <td>
                        <?php echo $id; ?>
                    </td>
                    
                    <td>
                        <?php echo $row['StateName']; ?>
                    </td>
                    <td><?php echo $row['category']; ?> </td>
                    <td><?php echo $row['status']; ?> </td>
                    <td><?php echo $row['workingStatus']; ?> </td>
                    <td><?php echo $row['total']; ?> </td>

                </tr>
              <?php }?>
            </tbody>
        </table>
    </div>
</div>