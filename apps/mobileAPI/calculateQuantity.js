
function calculateQty(){
    var frequencyO = document.getElementById("frequency").value;
    var durationUnitO = document.getElementById("durationUnit").value;
    frequency = frequencyO.replace(/\s/g, '');
    durationUni = durationUnitO.replace("(","");
    durationUnit = durationUni.replace(")","");
    
    //alert(durationUnit)
    
    var Frequency = {
            Immediately:"1", 
            Onceaday:"1", 
            Twiceaday:"2", 
            Thriceaday:"3", 
            Fourtimesaday:"4", 
            Every2hours:"12", 
            Every3hours:"8", 
            Every4hours:"6", 
            Every6hours:"4", 
            Every8hours:"3", 
            Every12hours:"2", 
            Onalternativedays:"1/2", 
            Onceaweek:"1/7", 
            Twiceaweek:"2/7", 
            Thriceaweek:"3/7", 
            Every2weeks:"1/14", 
            Every3weeks:"1/21", 
            Onceamonth:"1/30", 
            Fivetimesaday:"5", 
            Fourdaysaweek:"4/7", 
            Fivedaysaweek:"5/7", 
            Sixdaysaweek:"6/7"
        };

    var DurationUnit = {
            Days:"1", 
            Weeks:"7", 
            Months:"30"
        };

        frquencyValue = Frequency[frequency];
        
            
        durationUnitValue = DurationUnit[durationUnit];
        var dose = document.getElementById("dose").value;
        var duration = document.getElementById("duration").value;

        frquencyValue = frquencyValue==undefined ? 1 : frquencyValue;
        durationUnitValue = durationUnitValue==undefined ? 1 : durationUnitValue;
        dose = dose=="" ? 0 : dose;
        duration = duration=="" ? 1 : duration;
        if(frquencyValue.indexOf("/") !== -1 ){
            var exp=frquencyValue.split("/");
            var numerator = exp[0];
            var denominator = exp[1];
            frquencyValue = numerator/denominator;
        }
        var totalQty = dose * frquencyValue * duration * durationUnitValue;
        totalQty = Math.ceil(totalQty);
        document.getElementById("totalQty").value = totalQty;
        //alert(dose + " " + frquencyValue + " " + durationUnitValue + " " + duration + " = " + totalQty)
}