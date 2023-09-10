<?php
$Check_D = "select count(*) from providersdocuments where usersId = '$usersId' ";
$stmtD = $con->prepare($Check_D);
$stmtD->execute();
$rowsD = $stmtD->fetchColumn();
if ($rowsD > 0) {
?>
    <div class="table-header col-xs-12">
        Your Provided Supportive Documents
    </div>
    <table id="example" class="table table-stripped table-bordered table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>File Name</th>
                <th>File For</th>
                <th>File Size</th>
                <th>Uploaded Date</th>
                <th>Download or View</th>
            </tr>
        </thead>

        <tbody>
            <?php
            $U_query = "select * from providersdocuments where usersId='$usersId' order by File_For";
            $U_stmt = $con->prepare($U_query);
            $U_success = $U_stmt->execute();
            $U_rows = $U_stmt->fetchAll();
            $id = 0;
            foreach ($U_rows as $row) {

                $folder = $row['folder'];
                $fileName = $row['fileName'];
                $File_For = $row['File_For'];
                $fileSize = $row['fileSize'];
                $uploadedDate = $row['uploadedDate'];
            ?>
                <tr>
                    <?php $id = $id + 1; ?>
                    <td><?php echo $id; ?></td>
                    <td><?php echo $fileName; ?></td>
                    <td><?php echo $File_For; ?></td>
                    <td><?php echo $fileSize . ' byte'; ?></td>
                    <td><?php echo $uploadedDate; ?></td>
                    <td>
                        <a href="configurations/users/views/download.php?folder=<?php echo $folder; ?>&download_file=<?php echo $fileName; ?>"> <span class="label label-success arrowed "><i class="fa fa-cloud-download"></i> Download</span> </a>
                        <a href="#"> <span class="label label-danger arrowed "><i class="fa fa-trash"></i> Delete</span> </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } ?>