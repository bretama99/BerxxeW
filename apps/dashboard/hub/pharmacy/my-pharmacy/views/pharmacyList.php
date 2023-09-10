<?php ?>
<div id="myPharmacy" class="tab-pane">

    <div id="successfullyAdded"></div>

    <span style="font-size:1em;font-style: italic;display: block;margin-left:2%;"><b>N.B:&nbsp;</b>List of Registered Pharmacies. &nbsp;<b>ON:&nbsp;</b> means the pharmacy is verified (Prescription could be received). &nbsp;<b>Pending:&nbsp;</b> means the pharmacy is not verified yet. (could not receive prescriptions) <b>&nbsp;OFF:&nbsp;</b> means the pharmacy is not giving a service either temporarily or permanently. <br><br></span>
    <?php
    if ($_SESSION['rolesId'] == 2) {
        $select_pharmacy = "select pharmacy.*,woreda.woredaName,zone.zoneName, state.stateName,country.countryName from pharmacy INNER JOIN pharmacyusers on pharmacy.pharmacyId=pharmacyusers.pharmacyId INNER JOIN woreda on woreda.woredaId=pharmacy.woredaId INNER JOIN zone on zone.zoneId=pharmacy.zoneId INNER JOIN state on state.stateId=pharmacy.stateId  INNER JOIN country on country.countryId=pharmacy.countryId where pharmacyusers.usersId='$usrUsersId' and ((pharmacy.status='Active' || pharmacy.status='Disabled') and pharmacyusers.status='Active') ";
        $pharmacy_stmt = $con->prepare($select_pharmacy);
        $pharmacy_success = $pharmacy_stmt->execute();
        $rows_pharmacy = $pharmacy_stmt->fetchAll();
    } else  if ($_SESSION['rolesId'] == 4) {
        $pharmacy = "select pharmacy.*,woreda.woredaName,zone.zoneName, state.stateName,country.countryName from pharmacy INNER JOIN woreda on woreda.woredaId=pharmacy.woredaId INNER JOIN zone on zone.zoneId=pharmacy.zoneId INNER JOIN state on state.stateId=pharmacy.stateId  INNER JOIN country on country.countryId=pharmacy.countryId where pharmacy.isDeleted=0 and registeredById='" . $usrUsersId . "'";
        $pharmacy_stmt = $con->prepare($pharmacy);
        $pharmacy_success = $pharmacy_stmt->execute();
        $rows_pharmacy = $pharmacy_stmt->fetchAll();
    }
    ?>

    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="col-xs-12">
                    <table id="simple-table" class="table  table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="center">
                                    <label class="pos-rel">
                                        S/N
                                        <span class="lbl"></span>
                                    </label>
                                </th>
                                <th>Pharmacy Name</th>
                                <th>Category</th>
                                <th>
                                    Kebelle
                                </th>
                                <th>
                                    Street No.
                                </th>
                                <th>Phone Address</th>
                                <th>Email Address</th>

                                <th>Status</th>
                                <th style="width:2%;">&nbsp;</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $i = 0;
                            foreach ($rows_pharmacy as $row) {
                                $i++ ?>
                                <tr>
                                    <td class="center">
                                        <label class="pos-rel">
                                            <?php echo $i; ?>
                                            <span class="lbl"></span>
                                        </label>
                                    </td>

                                    <td><?php echo $row['pharmacyName']; ?></td>

                                    <td><?php echo $row['pharmacyType']; ?></td>

                                    <td><?php echo $row['kebelle']; ?></td>
                                    <td><?php echo $row['streetNumber']; ?></td>
                                    <td><?php echo $row['phoneNumber']; ?></td>
                                    <td><?php echo $row['email']; ?></td>

                                    <?php
                                    $checked1 = '';

                                    if ($row['status'] == 'Active')
                                        $checked1 = 'checked';
                                    else if ($row['status'] == 'Disabled')
                                        $checked1 = '';

                                    if ($row['status'] == 'Pending') { ?>
                                        <td><span class="label label-sm  label-warning"><?php echo $row['status']; ?> </span>
                                            <span> &nbsp;&nbsp;<a href="?name=hub/pharmacy/my-pharmacy/editpharmacy&var=editPharmacy&pharmacyId=<?php echo $row['pharmacyId']; ?>"><i class="ace-icon fa fa-pencil"></i></a> </span>

                                        </td>
                                    <?php } else { ?>

                                        <td> <input name="managedPharmacyId[]" type="hidden" value=" <?php echo $row['pharmacyId']; ?>" />
                                            <label>
                                                <input type="checkbox" boxIdPharmacy="<?php echo $row['pharmacyId']; ?>" <?php echo $checked1; ?> id="<?php echo $row['pharmacyId']; ?>" value="<?php echo $row['status']; ?>" name="pharmacyStatus[]" class="ace ace-switch ace-switch-3" onclick="manageCheckBoxPharmacy(this)" />
                                                <span class="lbl middle"></span>
                                            </label>
                                        </td>
                                    <?php } ?>

                                    <td class="center">
                                        <div class="action-buttons">
                                            <a href="#" class="green bigger-140 show-details-btn" title="Show Details">
                                                <i class="ace-icon fa fa-angle-double-down"></i>

                                            </a>

                                        </div>
                                    </td>
                                </tr>

                                <tr class="detail-row">
                                    <td colspan="11">
                                        <div class="table-detail">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-2">
                                                    <div class="text-center">
                                                        <img height="150" class="thumbnail inline no-margin-bottom" alt="" src="../images/pharmacy.png" />
                                                        <br />
                                                        <div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
                                                            <div class="inline position-relative">
                                                                <a class="user-title-label" href="#">
                                                                    <i class="ace-icon fa fa-circle light-green"></i>
                                                                    &nbsp;
                                                                    <span class="white"> <?php echo $row['pharmacyName']; ?></span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xs-12 col-sm-10">
                                                    <div class="space visible-xs"></div>

                                                    <div class="profile-user-info profile-user-info-striped">

                                                        <div class="profile-info-row">
                                                            <div class="profile-info-name" style="width:18%;"> Pharmacy Name </div>

                                                            <div class="profile-info-value">
                                                                <span><?php echo $row['pharmacyName']; ?> </span>
                                                            </div>
                                                        </div>

                                                        <div class="profile-info-row">
                                                            <div class="profile-info-name"> Category </div>

                                                            <div class="profile-info-value">
                                                                <span><?php echo $row['pharmacyType']; ?> </span>
                                                            </div>
                                                        </div>

                                                        <div class="profile-info-row">
                                                            <div class="profile-info-name"> Kebelle </div>

                                                            <div class="profile-info-value">
                                                                <span><?php echo $row['kebelle']; ?> </span>
                                                            </div>
                                                        </div>

                                                        <div class="profile-info-row">
                                                            <div class="profile-info-name"> Woreda</div>

                                                            <div class="profile-info-value">
                                                                <span><?php echo $row['woredaName']; ?> </span>
                                                            </div>
                                                        </div>

                                                        <div class="profile-info-row">
                                                            <div class="profile-info-name"> Zone/Subcity</div>

                                                            <div class="profile-info-value">
                                                                <span><?php echo $row['zoneName']; ?> </span>
                                                            </div>
                                                        </div>

                                                        <div class="profile-info-row">
                                                            <div class="profile-info-name">State</div>

                                                            <div class="profile-info-value">
                                                                <span><?php echo $row['stateName'] . ', ' . $row['countryName']; ?> </span>
                                                            </div>
                                                        </div>

                                                        <div class="profile-info-row">
                                                            <div class="profile-info-name"> Address </div>

                                                            <div class="profile-info-value">
                                                                <span><b>email:</b> <?php echo $row['email']; ?>
                                                                    <b>Phone:</b> <?php echo $row['phoneNumber']; ?> </span>
                                                            </div>
                                                        </div>

                                                        <div class="profile-info-row">
                                                            <div class="profile-info-name"> Location </div>

                                                            <div class="profile-info-value">
                                                                <i class="fa fa-map-marker light-orange bigger-110"></i>
                                                                <span><b>Latitude:</b> &nbsp;&nbsp; <?php echo $row['latitude']; ?> &nbsp;&nbsp;&nbsp;&nbsp;<b>Longitude:</b> <?php echo $row['longitude']; ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="detail-row">
                                    <td colspan='9'>
                                        <?php $arrayMapDiv[] = 'map' . $row['pharmacyId'];
                                        $arrayLng[] = $row['longitude'];
                                        $arrayLat[] = $row['latitude'];
                                        $arrayPharmacyName[] = $row['pharmacyName'];
                                        $arrayPharmacyType[] = $row['pharmacyType'];
                                        ?>

                                        <div id="map<?php echo $row['pharmacyId']; ?>" style="width:100%;height:400px;"></div>
                                    </td>
                                </tr>
                            <?php } ?>
                            <?php
                            ?>
                            <?php if ($i >= 1) { ?>
                                <tr style="background-color:white;" id="managePharmacySave">
                                    <td colspan="10"><br> <button style="float:right;" class="btn btn-lg btn-success" onclick="managePharmacy();"> <i class="ace-icon fa fa-check"> </i>Save</button></td>
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>