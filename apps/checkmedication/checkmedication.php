<!-- Section: boxes -->
<section id="Check_Medication" class="home-section paddingtop-100">
        <div class="intro-content">
          <div class="container">
            <div class="col-lg-6" style="margin-left:25%;">
              <div class="form-wrapper">
                <div class="wow fadeInRight" data-wow-duration="2s" data-wow-delay="0.2s">
    <section id="Check_Medication" class="home-section paddingtop-200">
                  <div class="panel panel-skin">
                    <div class="panel-heading" style="background: #749c5c">
                      <h3 class="panel-title"><span id="signup_for"> Check Medication (Coming Soon)</small></h3>
                    </div>
                    <div class="panel-body">
                        <input type="hidden" id="rolesId" name="rolesId" value="">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Medication(Drug) Code</label>
                              <div class="row">
                                <div class="col-sm-8">
                                    <input type="text" id="medicationCode" placeholder="Enter medication code" autocomplete="off" onkeyup="check_email();" class="form-control input-md" required />
                                </div>
                                <div class="col-sm-4">
                                  <input type="submit" value="Check" class="btn btn-skin btn-block btn-sm" style="background: #749c5c" onclick="checkMedication()">
                                </div>
                              </div>
                              <span id="medicationMessage"></span>
                              <div class="validation"></div>
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
      </section>
<!-- /Section: boxes -->
<script>
  function checkMedication(){
    var medicationCode = document.getElementById("medicationCode").value;
    if(medicationCode == ""){
      document.getElementById("medicationMessage").innerHTML="&#9888; Please enter the medication code to check.".fontcolor("red").fontsize(2);
    }else{
      document.getElementById("medicationMessage").innerHTML="&#10004; Check medication under construction ".fontcolor("green").fontsize(3);
    }
    
  }
</script>