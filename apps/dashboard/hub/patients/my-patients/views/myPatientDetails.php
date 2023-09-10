<?php ?>
<tr class="detail-row">
    <td colspan="8">
        <div class="table-detail">
            <div class="row">
                <div class="col-xs-12 col-sm-2">
                    <div class="text-center">
                        <?php $row['profilePicture'] == '' ? $image = $row['profilePicture'] : $image = 'defaultMale.jpg'; ?>
                        <img height="150" class="thumbnail inline no-margin-bottom" alt="" src="../../images/profile_pic/<?php echo $image; ?>" />
                        <br />
                        <div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
                            <div class="inline position-relative">
                                <a class="user-title-label" href="#">
                                    <i class="ace-icon fa fa-circle light-green"></i>
                                    &nbsp;
                                    <span class="white"><?php echo $row['firstName'] . ' ' . $row['fatherName']; ?></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-7">
                    <div class="space visible-xs"></div>

                    <div class="profile-user-info profile-user-info-striped">
                        <div class="profile-info-row">
                            <div class="profile-info-name"> Username </div>

                            <div class="profile-info-value">
                                <span><?php echo $row['userName']; ?></span>
                            </div>
                        </div>

                        <div class="profile-info-row">
                            <div class="profile-info-name"> Location </div>

                            <div class="profile-info-value">
                                <i class="fa fa-map-marker light-orange bigger-110"></i>
                                <span>Mekelle, Ethiopia</span>
                            </div>
                        </div>

                        <div class="profile-info-row">
                            <div class="profile-info-name"> Age </div>

                            <div class="profile-info-value">
                                <span>38</span>
                            </div>
                        </div>


                        <div class="profile-info-row">
                            <div class="profile-info-name">Patients Id </div>

                            <div class="profile-info-value">
                                <span>92</span>
                            </div>
                        </div>

                        <div class="profile-info-row">
                            <div class="profile-info-name"> Last Visit Day </div>

                            <div class="profile-info-value">
                                <span>3 hours ago</span>
                            </div>
                        </div>

                        <div class="profile-info-row">
                            <div class="profile-info-name"> Allergies </div>

                            <div class="profile-info-value">
                                <span>Bio</span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> Mobile Address </div>

                            <div class="profile-info-value">
                                <span><?php echo $row['mobilePhone']; ?> </span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> Email Address </div>

                            <div class="profile-info-value">
                                <span><?php echo $row['email']; ?> </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-3">
                    <div class="space visible-xs"></div>
                    <h4 class="header blue lighter less-margin">Send a message to <?php echo $row['firstName'] . ' ' . $row['fatherName'] . ' ' . $row['grandFatherName']; ?></h4>

                    <div class="space-6"></div>

                    <form>
                        <fieldset>
                            <textarea class="width-100" resize="none" placeholder="Type something…"></textarea>
                        </fieldset>

                        <div class="hr hr-dotted"></div>

                        <div class="clearfix">
                            <label class="pull-left">
                                <input type="checkbox" class="ace" />
                                <span class="lbl"> Email me a copy</span>
                            </label>

                            <button class="pull-right btn btn-sm btn-primary btn-white btn-round" type="button">
                                Submit
                                <i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </td>
</tr>