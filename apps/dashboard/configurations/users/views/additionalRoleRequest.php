<?php ?>
<div class="row">
    <div class="col-sm-12">
        <div id="accordion" class="accordion-style1 panel-group">
            <div class="panel panel-default">
                <div class="panel-collapse collapse" id="collapseOne">
                    <div class="widget-box widget-color-blue">
                        <div class="widget-header widget-header-small">
                            <h6 class="widget-title smaller">Request for Pharmacist Role</h6>
                        </div>

                        <div class="row">
                            <div class="widget-main">
                                <div class="widget-box col-sm-6" id="widget-box-12">
                                    <div class="widget-body">
                                        <div class="widget-main padding-6">
                                            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data" id="pharmacistinfo">
                                                <input type="hidden" name="rolesId" value=2>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Education Level</label>
                                                    <div class="col-sm-9">
                                                        <select name="educationalLevelId" id="educationalLevelId" class="chosen-select-pharmacist form-control" data-placeholder="Choose Educational Level" required>
                                                            <option value="">Choose</option>
                                                            <?php
                                                            $El_query = "select educationalLevelId,educationLevelName from educationallevel";
                                                            $El_stmt = $con->prepare($El_query);
                                                            $El_success = $El_stmt->execute();
                                                            $El_rows = $El_stmt->fetchAll();
                                                            foreach ($El_rows as $row) {
                                                                $educationalLevelId = $row['educationalLevelId'];
                                                                $educationLevelName = $row['educationLevelName'];
                                                            ?>
                                                                <option value="<?php echo $educationalLevelId; ?>"><?php echo $educationLevelName; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Graduated From</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="graduatedFrom" id="graduatedFrom" placeholder="Write university/College name" class="form-control" required />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> In Year</label>
                                                    <div class="col-sm-3">
                                                        <input type="number" maxlength="4" name="graduationYear" id="graduationYear" placeholder="In Year" class="form-control" max="<?php echo date('Y'); ?>" required />
                                                        <span id="mygraddate_error" style="display:none;"></span>
                                                    </div>
                                                    <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Qualification</label>
                                                    <div class="col-sm-4">
                                                        <select name="qualification" id="qualification" data-placeholder="Choose Qualification" required>
                                                            <option value="">Choose</option>
                                                            <option value="Senior">Senior</option>
                                                            <option value="Junior">Junior</option>
                                                            <option value="Chief">Chief</option>
                                                            <option value="Expert">Expert</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Licence No</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="licenceNo" id="licenceNo" placeholder="licence No" autocomplete="off" class="form-control" required />
                                                    </div>
                                                    <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Exp.Date </label>
                                                    <div class="col-sm-4">
                                                        <input type="date" name="licenceExpirationDate" id="licenceExpirationDate" placeholder="Expiration Date" class="form-control" onchange="checkLicence()" min="<?php echo date('Y-m-d'); ?>" required />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-7 control-label no-padding-right" id="ErrorDisplay" for="form-field-1"> </label>
                                                </div>
                                                <input type="hidden" name="requestPharmacistRole">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-box col-sm-6" id="widget-box-6">

                                    <form action="configurations/users/models/uploadpharmacist.php?action=save" class="dropzone" id="dropzoneFrom2">
                                        <div align="right">
                                            <button type="button" id="submit-all2"></button>
                                        </div>
                                    </form>

                                    <div id="preview2">
                                    </div>
                                    <br>

                                </div>
                            </div>
                        </div>
                        <br>
                        <div align="right">
                            <button class='btn btn-blue btn-primary' onclick='submitPharmacistForm()'>Send Request</button>
                        </div>
                    </div>
                </div>

                <div class="panel-collapse collapse" id="collapseTwo">
                    <div class="widget-box widget-color-orange">
                        <div class="widget-header widget-header-small">
                            <h6 class="widget-title smaller">Request for Physician Role</h6>
                        </div>

                        <div class="row">
                            <div class="widget-main">
                                <div class="widget-box col-sm-6" id="widget-box-12">
                                    <div class="widget-body">
                                        <div class="widget-main padding-6">
                                            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data" id="physicianinfo">
                                                <input type="hidden" name="rolesId" value=3>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Education Level</label>
                                                    <div class="col-sm-6">
                                                        <select name="educationalLevelId" id="educationalLevelId2" class="chosen-select-physcian form-control" data-placeholder="Choose Educational Level" required>
                                                            <option value="">Choose</option>
                                                            <?php
                                                            $El_query = "select educationalLevelId,educationLevelName from educationallevel";
                                                            $El_stmt = $con->prepare($El_query);
                                                            $El_success = $El_stmt->execute();
                                                            $El_rows = $El_stmt->fetchAll();
                                                            foreach ($El_rows as $row) {
                                                                $educationalLevelId = $row['educationalLevelId'];
                                                                $educationLevelName = $row['educationLevelName'];
                                                            ?>
                                                                <option value="<?php echo $educationalLevelId; ?>"><?php echo $educationLevelName; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Graduated From</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="graduatedFrom" id="graduatedFrom2" placeholder="Write university/College name" class="form-control" required />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Specialization</label>
                                                    <div class="col-sm-9">
                                                        <select name="specializationId" id="specialization2" class="chosen-select-physcian form-control" data-placeholder="Choose Specialization" required>
                                                            <?php
                                                            $El_query = "select specializationId,specializationName from specialization order by specializationName";
                                                            $El_stmt = $con->prepare($El_query);
                                                            $El_success = $El_stmt->execute();
                                                            $El_rows = $El_stmt->fetchAll();
                                                            foreach ($El_rows as $row) {
                                                                $specializationId = $row['specializationId'];
                                                                $specializationName = $row['specializationName'];
                                                            ?>
                                                                <option value="<?php echo $specializationId; ?>"><?php echo $specializationName; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Licence No</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="licenceNo" id="licenceNo2" placeholder="licence No" autocomplete="off" class="form-control" required />
                                                    </div>
                                                    <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Exp.Date </label>
                                                    <div class="col-sm-4">
                                                        <input type="date" name="licenceExpirationDate" id="licenceExpirationDate2" placeholder="Expiration Date" class="form-control" onchange="checkLicence()" min="<?php echo date('Y-m-d'); ?>" required />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> In Year</label>
                                                    <div class="col-sm-3">
                                                        <input type="number" name="graduationYear" id="graduationYear2" placeholder="In Year" class="form-control" onchange="checkGradYear(<?php echo date('Y'); ?>)" onkeyup="checkGradYear(<?php echo date('Y'); ?>)" class="form-control input-sm" max="<?php echo date('Y'); ?>" required />
                                                        <span id="mygraddate_error" style="display:none;"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Institution Name</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="HealthInstitutionName" id="HealthInstitutionName" placeholder="Health institution name you are working now" class="form-control" required />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-7 control-label no-padding-right" id="ErrorDisplay2" for="form-field-1"> </label>
                                                </div>
                                                <input type="hidden" name="requestPhysicianRole">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-box col-sm-6" id="widget-box-6">
                                    <form action="configurations/users/models/uploadphysician.php?action=save" class="dropzone" id="dropzoneFrom">

                                    </form>
                                    <br>
                                    <div id="preview">
                                    </div>
                                    <br>
                                    <div align="right">
                                        <button type="button" id="submit-all"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div align="right">
                            <button class='btn btn-blue btn-warning' onclick='submitPhysicianForm()'>Send Request</button>
                        </div>
                    </div>
                </div>

                <div class="panel-collapse collapse" id="collapseThree">
                    <div class="widget-box widget-color-green">
                        <div class="widget-header widget-header-small">
                            <h6 class="widget-title smaller">Request for Pharmacy Owner Role</h6>
                        </div>
                        <div class="tab-pane">
                            <div id="notAdded"></div>
                            <?php include('hub/pharmacy/my-pharmacy/views/addnewPharmacy.php'); ?>
                            <div id="notAddedFooter"></div>
                        </div>

                        <div class="row">
                            <div class="widget-main">
                                <div class="widget-box col-sm-6" id="widget-box-6">
                                    <div class="widget-body">
                                        <div class="widget-main padding-6">
                                            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data" id="pharmacyownerinfo">
                                                <input type="hidden" name="rolesId" value=4>
                                                <input type="hidden" name="requestPharmacyOwnerRole">
                                            </form>
                                            <form action="configurations/users/models/uploadpharmacyowner.php?action=save" class="dropzone" id="dropzoneFrom3">

                                            </form>
                                            <br>

                                            <!-- <div align="right">
                                                <button type="button" id="submit-all3"></button>
                                            </div> -->
                                            <div id="preview3">
                                            </div>
                                            <div align="right">
                                                <button class='btn btn-blue btn-success' onclick='submitPharmacyOwnerForm()'>Send Request</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>