<?php ?>
<table id="example" class="table table-stripped table-bordered table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Requested for</th>
            <th>Request Date</th>
            <th>Status</th>
        </tr>
    </thead>

    <tbody>
        <?php
        $U_query = "select rolesName,rolerequest.status,rolerequest.rolesId,requestDate from 
								rolerequest join roles ON roles.rolesId=rolerequest.rolesId where rolerequest.usersId='$usersId'";
        $U_stmt = $con->prepare($U_query);
        $U_success = $U_stmt->execute();
        $U_rows = $U_stmt->fetchAll();
        $id = 0;
        foreach ($U_rows as $row) {

            $status = $row['status'];
            $rolesId = $row['rolesId'];
            $rolesName = $row['rolesName'];
            $requestDate = $row['requestDate'];
        ?>
            <tr <?php if ($status == 'disabled') {
                    echo  'style="background:#ffb3b3;"';
                } ?>>
                <?php $id = $id + 1; ?>
                <td><?php echo $id; ?></td>
                <td><?php echo $rolesName; ?></td>
                <td><?php echo $requestDate; ?></td>
                <td>
                    <?php
                    if ($status == 'Approved') {
                        echo '<span class="label label-success arrowed">' . $status . '</span>';
                    } else if ($status == 'Pending') {
                        echo '<span class="label label-warning arrowed">' . $status . '</span>';
                    } else if ($status == 'Denied') {
                        echo '<span class="label label-danger arrowed">' . $status . '</span>';
                    }
                    ?>
                </td>

            </tr>
        <?php } ?>
    </tbody>
</table>