$(function(){
   // $('.chzn-select').select2();
  
  
    $("#wizard").bootstrapWizard({onTabShow: function(tab, navigation, index) {
        var $total = navigation.find('li').length;
        var $current = index+1;
        var $percent = ($current/$total) * 100;
        var $wizard = $("#wizard");
        $wizard.find('.bar').css({width:$percent+'%'});
        if($current >= $total) {
            $wizard.find('.pager .next').hide();
            $wizard.find('.pager .finish').show();
	            $wizard.find('.pager .finish').removeClass('disabled');
				$("#fname").val($("#test-fname").val());
				$("#mname").val($("#test-mname").val());
				$("#lname").val($("#test-lname").val());
				$("#address").val($("#test-address").val());
				$("#gender").val($("#test-gender").val());
				$("#dob").val($("#test-dob").val());
				$("#contact").val($("#test-contact").val());
				$("#year").val($("#test-year").val());
				$("#block").val($("#test-block").val());
				$("#xsy").val($("#testsy").val());
				$("#company-name").val($("#test-company-name").val());
				$("#company-address").val($("#test-company-address").val());
				$("#company-head").val($("#test-company-head").val());
				$("#company-contact").val($("#test-company-contact").val());
				$("#company-email").val($("#test-company-email").val());
				$("#company-start").val($("#test-start").val());
				$("#company-end").val($("#test-end").val());
				
				var progress = setInterval(function() {

					
				$("#form-main").submit();
				},1000);
				
        } else {
            $wizard.find('.pager .next').show();
            $wizard.find('.pager .finish').hide();
			
        }
    }});
});