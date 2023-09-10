<?php
include ('../../constants/security/hash.php');
 /*if (isset($_GET['Id']) && !integrityCheck($_GET['Id'].''.$_GET['prescriptionId'].''.$_GET['status'],$_GET['hash'])){
    echo "This is not valid page! please don't try URI by your own!";
 } else { */
?>
<div class="widget-box">
    <div class="widget-header">
        <h4 class="widget-title">
            <?php echo $lang['patientInfo']; ?>
        </h4>
    </div>
    <div class="widget-body">
        <div class="table-detail">
            <?php if (isset($_GET['Id'])) {

                $usersId = $_GET['Id'];
                $Usr_query = "select titleName,firstName,fatherName,grandFatherName,gender,dateOfBirth,email,mobilePhone,profilePicture,countryId,stateId,zoneId,woredaId,kebelle from users join title on users.titleId=title.titleId where usersId='$usersId'";
                $Usr_stmt = $con->prepare($Usr_query);
                $Usr_success = $Usr_stmt->execute();
                $rows = $Usr_stmt->fetchAll();
                foreach ($rows as $row) {
                    $title = $row['titleName'];
                    $firstName = $row['firstName'];
                    $fatherName = $row['fatherName'];
                    $grandFatherName = $row['grandFatherName'];
                    $gender = $row['gender'];
                    $dateOfBirth = $row['dateOfBirth'];
                    $email = $row['email'];
                    $mobilePhone = $row['mobilePhone'];
                    $profilePicture = $row['profilePicture'];
                    $countryId = $row['countryId'];
                    $stateId = $row['stateId'];
                    $zoneId = $row['zoneId'];
                    $woredaId = $row['woredaId'];
                    $kebelle = $row['kebelle'];
                    $fullName1 = $title . ' ' . $firstName . ' ' . $fatherName . ' ' . $grandFatherName;
                }
                if (empty($profilePicture)) {
                    $profilePicture = $gender == "Male" ? "defaultMale.jpg" : "defaultFemale.jpg";
                }
            ?>
                <div class="row">
                    <div class="col-xs-12 col-sm-2">
                        <div class="text-center">
                            <img height="150" class="thumbnail inline no-margin-bottom" alt="Profile picture" src="../../images/profile_pic/<?php echo $profilePicture; ?>" />
                            <br />
                            <div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
                                <div class="inline position-relative">
                                    <a class="user-title-label" href="#">
                                        <i class="ace-icon fa fa-circle light-green"></i>
                                        &nbsp;
                                        <span class="white">
                                            <?php echo $title . ' ' . $firstName; ?>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-10">
                        <div class="space visible-xs"></div>

                        <div class="profile-user-info profile-user-info-striped">
                            <div class="profile-info-row">
                                <div class="profile-info-name">
                                    <?php echo $lang['fullName']; ?>
                                </div>

                                <div class="profile-info-value">
                                    <span>
                                        <?php echo $fullName1; ?>
                                    </span>
                                </div>
                            </div>

                            <div class="profile-info-row">
                                <div class="profile-info-name">
                                    <?php echo $lang['mobilePhone']; ?>
                                </div>

                                <div class="profile-info-value">
                                    <i class="fa fa-phone light-orange bigger-110"></i>
                                    <span>
                                        <?php echo $mobilePhone; ?>
                                    </span>
                                </div>
                            </div>
                            <div class="profile-info-row">
                                <div class="profile-info-name">
                                    <?php echo $lang['email']; ?>
                                </div>

                                <div class="profile-info-value">
                                    <i class="fa fa-envelope-o light-orange bigger-110"></i>
                                    <span>
                                        <?php echo $email; ?>
                                    </span>
                                </div>
                            </div>

                            <div class="profile-info-row">
                                <div class="profile-info-name">
                                    <?php echo $lang['address']; ?>
                                </div>
                                <?php
                                $Usr_query = "select countryName from country where countryId='$countryId'";
                                $Usr_stmt = $con->prepare($Usr_query);
                                $Usr_success = $Usr_stmt->execute();
                                $rows = $Usr_stmt->fetchAll();
                                foreach ($rows as $row) {
                                    $countryName = $row['countryName'];
                                }
                                $Usr_query = "select stateName from state where stateId='$stateId'";
                                $Usr_stmt = $con->prepare($Usr_query);
                                $Usr_success = $Usr_stmt->execute();
                                $rows = $Usr_stmt->fetchAll();
                                foreach ($rows as $row) {
                                    $stateName = $row['stateName'];
                                }
                                $Usr_query = "select zoneName from zone where zoneId='$zoneId'";
                                $Usr_stmt = $con->prepare($Usr_query);
                                $Usr_success = $Usr_stmt->execute();
                                $rows = $Usr_stmt->fetchAll();
                                foreach ($rows as $row) {
                                    $zoneName = $row['zoneName'];
                                }
                                $Usr_query = "select woredaName from woreda where woredaId='$woredaId'";
                                $Usr_stmt = $con->prepare($Usr_query);
                                $Usr_success = $Usr_stmt->execute();
                                $rows = $Usr_stmt->fetchAll();
                                foreach ($rows as $row) {
                                    $woredaName = $row['woredaName'];
                                }
                                ?>
                                <div class="profile-info-value">
                                    <i class="fa fa-map-marker light-orange bigger-110"></i>
                                    <span>
                                        <?php if (!empty($kebelle)) {
                                            echo $lang['kebelle']; ?> - <b>
                                            <?php echo $kebelle . ',';
                                        } ?>
                                            </b>
                                            <?php if (isset($woredaName)) {
                                                echo $lang['wereda']; ?> -
                                                <b>
                                                <?php echo $woredaName . ',';
                                            } ?>
                                                </b>
                                                <?php if (isset($zoneName)) {
                                                    echo $lang['zone']; ?>
                                                    - <b>
                                                    <?php echo $zoneName . ',';
                                                } ?>
                                                    </b> <b>
                                                        <?php if (isset($stateName)) {
                                                            echo $stateName . ',';
                                                        } ?>
                                                    </b> <b>
                                                        <?php if (isset($countryName)) {
                                                            echo $countryName;
                                                        } ?>
                                                    </b>
                                    </span>
                                </div>
                            </div>
                            <div class="profile-info-row">
                                <div class="profile-info-name">
                                    <?php echo $lang['dateOfBirth']; ?>
                                </div>

                                <div class="profile-info-value">
                                    <span>
                                        <?php if (isset($dateOfBirth)) {
                                            echo $dateOfBirth;
                                        } ?>
                                    </span>
                                </div>
                            </div>
                            <div class="profile-info-row">
                                <div class="profile-info-name">
                                    <?php echo $lang['allergies']; ?>
                                </div>
                                <div class="profile-info-value">
                                    <span></span>
                                </div>
                                <input type="hidden" id="patientUsersId" value="<?php echo $usersId; ?>">
                            </div>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="row">
                    <form class="form-horizontal" role="form" id="userInfo">
                        <fieldset>
                            <div class="col-sm-3">
                                <label for="form-field-8">
                                    <?php echo $lang['title']; ?>
                                </label>
                                <select name="title" class="form-control" id="title" required>
                                    <option value="">select title</option>
                                    <?php
                                    $t_query = "select * from title";
                                    $t_stmt = $con->prepare($t_query);
                                    $t_success = $t_stmt->execute();
                                    $t_rows = $t_stmt->fetchAll();
                                    foreach ($t_rows as $row) {
                                        $titleId = $row['titleId'];
                                        $titleName = $row['titleName'];
                                    ?>
                                        <option value="<?php echo $titleId; ?>"><?php echo $titleName; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <label for="form-field-8">
                                    <?php echo $lang['firstName']; ?>
                                </label>
                                <input type="text" name="firstName" class="form-control" id="firstName" placeholder="<?php echo $lang['firstName']; ?>">
                            </div>
                            <div class="col-sm-3">
                                <label for="form-field-8">
                                    <?php echo $lang['fatherName']; ?>
                                </label>
                                <input type="text" name="fatherName" class="form-control" id="fatherName" placeholder="Father name">
                            </div>
                            <div class="col-sm-3">
                                <label for="form-field-8">
                                    <?php echo $lang['grandFatherName']; ?>
                                </label>
                                <input type="text" name="grandFatherName" class="form-control" id="grandFatherName" placeholder="Grandfathe name">
                            </div>
                            <div class="col-sm-3">
                                <label for="form-field-8">
                                    <?php echo $lang['mobilePhone']; ?>
                                </label>
                                <input type="text" name="mobilePhone" class="form-control" id="mobilePhone" placeholder="Mobile phone" maxlength="10" onkeyup="check_phone('');">
                                <?php include('../homepage/signup/views/checkphone.php'); ?>
                                <span id="phone-message"></span>
                            </div>
                            <div class="col-sm-3">
                                <label for="form-field-8" title="Emergency Contact Phone Number, if you don't have your own phone address">
                                    Custodian Phone
                                </label>
                                <input type="text" name="custodianPhone" class="form-control" id="custodianPhone" placeholder="Custodian" maxlength="10">
                            </div>
                            <div class="col-sm-3">
                                <label for="form-field-8">
                                    <?php echo $lang['gender']; ?>
                                </label>
                                <select name="title" class="form-control" id="gender" required>
                                    <option value="">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Female">Other</option>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <label for="form-field-8">
                                    <?php echo $lang['dateOfBirth']; ?>
                                </label>
                                <input type="date" name="dateOfBirth" class="form-control" id="dateOfBirth" max="<?php echo date('Y-m-d'); ?>">
                            </div>

                            <!-- 
            <div class="col-sm-2">
                <label for="form-field-8"><?php echo $lang['email']; ?></label>
                <input type="email" name="email" class="form-control" id="email" placeholder="email address" >
            </div>	
            <div class="col-sm-2">
                <label for="form-field-8"><?php echo $lang['country']; ?></label>
                <select name="country" class="chzn-select form-control" data-placeholder="Choose Country" id="country" onchange="display_states(this.options[this.selectedIndex].value,'state');" required>
                  <?php
                    $Po_query = "select countryId,countryName from country where isDeleted='0'";
                    $Po_stmt = $con->prepare($Po_query);
                    $Po_success = $Po_stmt->execute();
                    $Po_rows = $Po_stmt->fetchAll();
                    foreach ($Po_rows as $row) {
                        $countryId = $row['countryId'];
                        $countryName = $row['countryName'];
                    ?>
                    <option value="<?php echo $countryId; ?>"><?php echo $countryName; ?></option>
                    <?php } ?>
                </select>
            </div>	
            <div class="col-sm-2">
                <label for="form-field-8"><?php echo $lang['state']; ?></label>
                <select name="state" class="form-control" data-rel="tooltip" title="Select state...." id="state" onchange="display_zones(this.options[this.selectedIndex].value,'zone');">   
                <option value=""> Select State</option>
                <?php
                $Po_query = "select stateId,stateName from state where countryId='1' && isDeleted='0'";
                $Po_stmt = $con->prepare($Po_query);
                $Po_success = $Po_stmt->execute();
                $Po_rows = $Po_stmt->fetchAll();
                foreach ($Po_rows as $row) {
                    $stateId = $row['stateId'];
                    $stateName = $row['stateName'];
                ?>
                    <option value="<?php echo $stateId; ?>"><?php echo $stateName; ?></option>
                    <?php } ?>   
                    
                </select>
            </div>	
            <div class="col-sm-2">
                <label for="form-field-8"><?php echo $lang['zone']; ?></label>
                <select name="zone" class="form-control" data-rel="tooltip" title="Select zone...." id="zone" onchange="display_woredas(this.options[this.selectedIndex].value,'woreda');">   
                    <option value=""> ... Select Zone...</option>
                </select>
            </div>	
            <div class="col-sm-2">
                <label for="form-field-8"><?php echo $lang['wereda/city']; ?></label>
                <select name="woreda" class="form-control" data-rel="tooltip" title="Select Wereda/City...." id="woreda">   
                    <option value="">Select Wereda/City</option>
                </select>
            </div>	
            <div class="col-sm-2">
                <label for="form-field-8"><?php echo $lang['kebelle']; ?></label>
                <input type="text" name="kebelle" class="form-control" id="kebelle" placeholder="kebelle" >
            </div>	   -->
                            <?php include('configurations/addresses/common/addresses.php'); ?>
                        </fieldset>
                    </form>
                </div>

            <?php } ?>
        </div>
    </div>
</div>
<?php include('hub/prescriptions/prescribe/views/prescriptionform.php');?>

<?php //} ?>