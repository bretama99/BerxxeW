<?php include('configurations/addresses/views/displayaddressforuse.php'); ?>

<div id="myPharmacies" class="tab-pane">

    <div id="notAdded"></div>
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="col-xs-12">

                    <form name="addPharmacy" method="post" action="">
                        <table id="addPharmacyDiv" class="table table-striped">
                            <tr>
                                <td> Pharmacy Name*</td>
                                <td>
                                    <input id="pharmacyNameAdd" type="textbox" name="pharmacyNameAdd" class="form-control" />
                                </td>
                                <td> Pharmacy Type* </td>
                                <td>
                                    <select id="pharmacyTypeAdd" name="pharmacyTypeAdd" class="form-control" />
                                    <option>Rular Drug Shop</option>
                                    <option>Drug Shop</option>
                                    <option>Pharmacy</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>

                                <td>
                                    Licence Number*
                                </td>
                                <td>
                                    <input type="textbox" id="licenceNumberAdd" name="licenceNumber" class="form-control" />
                                </td>

                                <td>
                                    Registration Number*
                                </td>
                                <td>
                                    <input type="textbox" id="registrationNumberAdd" name="registrationNumber" class="form-control" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Tin Number*
                                </td>
                                <td>
                                    <input type="textbox" id="tinNumberAdd" name="tinNumberAdd" class="form-control" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Country*
                                </td>
                                <td>
                                    <select name="country" class="form-control" data-rel="tooltip" title="Select country...." id="country" onchange="display_states(this.options[this.selectedIndex].value,'state');">
                                        <option value=""> ... Select Country...</option>
                                        <?php
                                        $C_query = "select * from country where isDeleted=0 order by countryName";
                                        $C_stmt = $con->prepare($C_query);
                                        $C_success = $C_stmt->execute();
                                        $C_rows = $C_stmt->fetchAll();
                                        $id = 0;
                                        foreach ($C_rows as $row) {
                                            $countryId = $row['countryId'];
                                            $countryName = $row['countryName'];
                                            $id = $id + 1;
                                        ?>
                                            <option value="<?php echo $countryId; ?>"> <?php echo $countryName; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td>
                                    State/Region*
                                </td>
                                <td>

                                    <select name="state" class="select form-control" data-rel="tooltip" title="Select state...." id="state" onchange="display_zones(this.options[this.selectedIndex].value,'zone');">
                                        <option value=""> ... Select State...</option>
                                    </select>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    SubCity/Zone*
                                </td>

                                <td>
                                    <select name="zone" class="form-control" data-rel="tooltip" title="Select zone...." id="zone" onchange="display_woredas(this.options[this.selectedIndex].value,'woreda');">
                                        <option value=""> ... Select Zone...</option>
                                    </select>
                                </td>

                                <td>
                                    Woreda
                                </td>
                                <td>
                                    <select id="woreda" name="woreda" class="form-control" data-rel="tooltip" title="Select woreda....">
                                        <option value=""> ... Select woreda...</option>
                                    </select>
                                </td>

                            </tr>
                            <tr>

                                <td>
                                    Kebelle*
                                </td>
                                <td>
                                    <input id="kebelleAdd" type="textbox" name="kebelle" class="form-control" />
                                </td>

                                <td>
                                    Street No.
                                </td>
                                <td>
                                    <input id="streetNumberAdd" type="textbox" name="streetNumberAdd" class="form-control" />
                                </td>

                            </tr>
                            <tr>

                                <td>
                                    Email Address*
                                </td>
                                <td>
                                    <input id="emailAdd" type="textbox" name="emailAdd" class="form-control" />
                                </td>

                                <td>
                                    Phone No.*
                                </td>
                                <td>
                                    <input id="phoneNumberAdd" type="text" name="phoneNumberAdd" class="form-control" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Opening Time.*
                                </td>
                                <td>
                                    <input id="openingTimeAdd" type="time" name="openingTimeAdd" class="form-control" />
                                </td>
                                <td>
                                    Closing Time.*
                                </td>
                                <td>
                                    <input id="closingTimeAdd" type="time" name="closingTimeAdd" class="form-control" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Latitude*
                                </td>
                                <td>
                                    <input type="text" id="lat" placeholder="Latitude" class="form-control" readonly="readonly">
                                </td>
                                <td>
                                    Longitude*
                                </td>
                                <td>
                                    <input type="text" id="lng" placeholder="Longitude" class="form-control" readonly="readonly">
                                    <input type="hidden" id="regById" value="<?php echo $_SESSION['usrUsersId']; ?>" class="form-control" readonly="readonly">
                                </td>
                            </tr>
                            <tr>
                                <td colspan='4'>
                                    <div id="map" style="width:100%;height:400px;"></div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan='2'>
                                </td>
                                <td><button type="button" id="submitAddPharmacy" name="submit" value="save" onclick="alert('Please fill all fields before you. Are you sure you want to add a new pharmacy into the system?')"> Add New Pharmacy </button> </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <div id="notAddedFooter"></div>
</div>