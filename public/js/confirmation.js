$(document).ready(function(){
  $('.confirmation').on('click', function () {
    return confirm('Are you sure?');
  });

  /* Makes the Languages selector to show the flags.*/
  $(function(){
    $('.selectpicker').selectpicker();
  });
  
  /* The variable holds the number of evaluators of the current survey*/
  var evaluatorsAmount = $('#numberOfEvaluators').data("field-id");

  /* Hide the closed Survey when the checkbox is checked */
  $('[name="hide"]').click(function()
  {
    var $this = $(this);
    if($this.is(':checked'))
    {
      var $row = $this.closest('tr');
      $row.fadeOut('slow');
      $('[name="showAll"]').prop('checked', false);
    }

  });

  /* Show all the closed Survey when the Show All button is clicked */
  $('[name="showAll"]').change(function()
  {
    var $this = $(this);
    if($this.is(':checked'))
    {
      $('[name="closedSurvey"]').each(function(index, row)
      {
        $(row).fadeIn('slow');
        $('[name="hide"]').prop('checked', false);
      });
    }
    else
    {
      $('[name="closedSurvey"]').each(function(index, row)
      {
        $(row).fadeOut('slow');
      });
    }
  });

  /* Allows to add external evaluator in peer survey*/
  $('#externalEvaluator').on('click',
  function()
  {
    if(countEvaluator() < evaluatorsAmount)
    {
    var newRow =
    $("<tr>\
      <td colspan='2'>\
        <input style='width: 35%; float:left;' id='email' type='email' class='form-control' placeholder='Enter email address'/>\
        <button type='button' class='remove btn btn-info glyphicon glyphicon-remove'  style='float:right;' />\
      </td>\
    </tr>");
    newRow.prependTo('#tfooter');
  }
  else
  {
    // Notice there is already 5 evaluators
    notice();
  }
  });

  /* Counts the current number of selected evaluators*/
  function countEvaluator()
  {
    var currentEvaluatorsQuantity = $('#example7 tbody input[name="usersToEvaluate[]"]:checked').length + $('#example7 tfoot tr').length - 1;
    return currentEvaluatorsQuantity;
  }

  /* Notice there is already 5 evaluators*/
  function notice()
  {
    $('#externalEvaluatorModal').modal('show');
  }

  /* Check that there will not be more than 5 evaluators are selected including externalEvaluator*/
  $('[name="usersToEvaluate[]"]').change(function()
  {
    var $this = $(this);
    if(countEvaluator() > evaluatorsAmount)
    {
      $this.prop('checked', false);
      notice();
    }
  });

  /* Remove rows when number of current evaluators > 5*/
  $(document).on('click', '.remove',
    function()
    {
      var $row = $(this).closest('tr');
      $row.fadeOut(250, function()
      {
        $(this).remove();
      });
    }
  );

  /* Trigger the singleDatePicker when edit a survey*/
  $(function() {
    $('input[name="startDate"], input[name="endDate"]').daterangepicker(
      {
        singleDatePicker: true,
        timePicker: true
        // minDate: moment()
      }
    )
    /* set the format of the picked value */
    .on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('YYYY-MM-DD h:mm A'));
      $(this).val(picker.endDate.format('YYYY-MM-DD h:mm A'));
    });
  });

  /* Show/Hide the option Number of Evaluators depedning on the survey type
  when admin create a survey*/
  function checkSurveyType() {
    var $option = $('input[name="numberOfEvaluators"]').closest('div');
    /* show the option to input how many evaluators if the peer survey (value == 2) is selected */
    if($('input[name="survey_type"]:checked').val() == 2)
    {
      $option.fadeIn('slow');
    }
    else
    {
      $option.fadeOut('slow');
    }
  }
  // check when the page loads
  checkSurveyType();
  $('input[name="survey_type"]').change(
    function() {
      checkSurveyType();
    }
  );
  /* Only shows the corresponding fields of the professional status in the EditProfile blade*/
  $(function () {
    $('select[name="professional_status"]').change();
  });
  $('select[name="professional_status"]').change(
    function() {
      var professionalStatus = $(this).val();
      /* Choose the fields to hide*/
      var hidingFields = professionalStatus == "Professional" ? $('div[name="student-field"]') : $('div[name="professional-field"]');
      /* Choose the fields to show*/
      var displayingFields = professionalStatus == "Student" ? $('div[name="student-field"]') : $('div[name="professional-field"]');
      hidingFields.fadeOut('slow');
      displayingFields.fadeIn('slow');
    //   /* Set the view to the displaying fields*/
    //   $("html, body").delay(0).animate({
    //     scrollTop: displayingFields.offset().top
    // }, 500);
    }
  ).change();

  /* Show the corresponding results of selected type in Statistics*/
  function checkStatisticsType() {
    var statisticsType = $('select[name="statisticsType"]').val();
    var hidingChart = statisticsType == "Student" ? $('#statisticsIndicatorGroupAverageOfProfessional') : $('#statisticsIndicatorGroupAverageOfStudent');
    var displayingChart = statisticsType == "Professional" ? $('#statisticsIndicatorGroupAverageOfProfessional') : $('#statisticsIndicatorGroupAverageOfStudent');
    var hidingTable = statisticsType == "Student" ? $('#indicator_group_average_scores_compared_to_statistics_professional') : $('#indicator_group_average_scores_compared_to_statistics_student');
    var displayingTable = statisticsType == "Professional" ? $('#indicator_group_average_scores_compared_to_statistics_professional') : $('#indicator_group_average_scores_compared_to_statistics_student');
    hidingChart.fadeOut('fast');
    displayingChart.fadeIn('fast');
    hidingTable.fadeOut('fast');
    displayingTable.fadeIn('fast');
  }

  checkStatisticsType();
  $('select[name="statisticsType"]').change(function() {
    checkStatisticsType();
  });


  //add template description to every survey
  var description = "Innovation encourages an organisation to develop a knowledge-based competitive advantage. Innovation is often a critical component for success in today’s working world and so the FINCODA Innovation Barometer Assessment Tool gives organisations and individuals the ability to assess their capacity for innovation – by assessing individual levels of innovativeness. Innovation is a process that allows for the introduction of a new product or service, new production methods, opens up new markets, identifies new suppliers, and business or management models that result in enhanced performance by, or within, the organization. Therefore, innovation starts with the generation of new ideas and finishes with the use or commercial exploitation of the outcomes.<br><br>The Fincoda Barometer includes five Innovation competencies that span the process of innovation from idea to outcome. The following five dimensions are measured using the FINCODA Barometer: creativity, critical thinking, initiative, teamwork and networking. As it is unlikely that an individual would show a high mastery on all five innovation competencies, an innovator is defined as someone who has a high mastery on one or more of the five innovation competencies.";

  $("textarea#editor1:not(.createGroup)").val(description);

  /* validate the input number of evaluators when creating peer survey on leaveFocus event of input field */
  function validateEvaluatorsNumber() {
    var evaluatorsInput = $('input[name = "numberOfEvaluators"]');
    var minimumAmount = 3;
    //chooses maximum amount depending on the current group or organization
    var maximumAmount = $('#groupMemberAmountList').length != 0 ? $('#groupMemberAmountList').find('option:selected').data('amount') :
    $('#totalParticipantsNumber').data('amount');
    console.log(maximumAmount);
    // console.log(evaluatorsInput.val());
    
    
    // validate the minimum and maximum the amount could be with selected group
    if(evaluatorsInput.val() != '' && (evaluatorsInput.val() < minimumAmount || evaluatorsInput.val() > maximumAmount)){
      //show the message to user
      $('#evaluatorValidationError').modal('show');
      //clears input value & notifies user to input new value
      $('input[name = "numberOfEvaluators"]').css('border-color', 'red');
      evaluatorsInput.val('');
      var timer;
      clearTimeout(timer);
      evaluatorsInput.css('border-color', 'red');
      timer = setTimeout(function() {
        // reset CSS
        evaluatorsInput.css('border-color', '');
      }, 5000);

    }
  }
  //
  $('input[name = "numberOfEvaluators"]').change(function(){
    validateEvaluatorsNumber();
  });


  /* update the selected group maximum input evaluators when create survey*/
  $('#groupMemberAmountList').change(
    function() {
      // var selectedOption = $(this).find('option:selected');
      // console.log(selectedOption.data('amount'));
      validateEvaluatorsNumber();
    }
  );

  //REGULAR EXPRESSION FOR EVERY INPUT:

      //homepage contact input
      $("#submit-home-contact").on('click', function() {
        var text = '';

        var name = $("#name1").val();
        var email = $("#email1").val();
        var message = $("#message1").val();

        if (!validateFullName(name)) {
          text += 'Full name invalid. Please enter the correct name.\n';
        }
        if (!validateEmail(email)) {
          text += 'Email invalid. Please enter the correct email.\n';
        }
        if (!validateTextarea(message)) {
          text += 'Message invalid. Please enter the correct message.';
        }

        if(text === ''){
          return true;
        }
        else {
          alert(text);
          return false;
        }
      });

      //company register
      $("#company-reg").on('click', function() {
        var text = '';
        var name = $("#com-name-reg").val();
        var type = $("#com-type-reg").val();
        var city = $("#com-type-reg").val();
        var address = $("#com-type-reg").val();
        var comEmail = $("#com-email-reg").val();
        var phone = $("#com-phone-reg").val();
        var postcode = $("#com-postcode-reg").val();
        var timezone = $("#com-timezone-reg").val();

        var adminName = $("#ad-name-reg").val();
        var adminEmail = $("#ad-email-reg").val();
        var password = $("#ad-pass-reg").val();
        var confirmPass = $("#ad-repass-reg").val();


        if(!validateFullName(name)){
          text += 'Company name invalid. Please enter the correct name.\n';
        }
        if(!validateFullName(type)){
          text += 'Company type invalid. Please enter the correct type.\n';
        }
        if(!validateCity(city)){
          text += 'City invalid. Please enter the correct city.\n';
        }
        if(!validateAddress(address)){
          text += 'Company address invalid. Please enter the correct address.\n';
        }
        if(!validateEmail(comEmail)){
          text += 'Company email invalid. Please enter the correct email.\n';
        }
        if(!validatePhone(phone)){
          text += 'Company phone number invalid. Please enter the correct phone number.\n';
        }
        if(!validatePostcode(postcode)){
          text += 'Company post code invalid. Please enter the correct post code.\n';
        }
        if(timezone === ''){
          text += 'Company time zone blank. Please select the correct timezone.\n\n';
        }

        if(!validateFullName(adminName)){
          text += 'Admin name invalid. Please enter the correct name.\n';
        }
        if(!validateEmail(adminEmail)){
          text += 'Admin email invalid. Please enter the correct email.\n';
        }
        if(validatePassword(password)){
          if( password !== confirmPass ){
            text += 'Password does not match. Please enter the password again.';
          }
        }
        else {
          text += 'Password should contain at least 6 characters, 1 number, 1 uppercase letter and 1 lowercase letter.'
        }

        if(text === ''){
          return true;
        }
        else {
          alert(text);
          return false;
        }

      });

      //company member register
      $("#user-reg").on('click', function(){
        var text = '';
        var code = $("#com-code-reg").val();
        var email = $("#email-reg").val();
        var name = $("#name-reg").val();
        var password = $("#user-pass-reg").val();
        var confirmPass = $("#user-repass").val();

        if (!validateCode(code)) {
          text += 'Company code invalid. Please enter the correct form of code.\n';
        }
        if (!validateFullName(name)) {
          text += 'Full name invalid. Please enter the correct name.\n';
        }
        if (!validateEmail(email)) {
          text += 'Email invalid. Please enter the correct email.\n';
        }
        if(validatePassword(password)) {
          if( password !== confirmPass ){
            text += 'Password does not match. Please enter the password again.';
          }
        }
        else {
          text += 'Password should contain at least 6 characters, 1 number, 1 uppercase letter and 1 lowercase letter.'
        }

        if(text === ''){
          return true;
        }
        else {
          alert(text);
          return false;
        }
      });

});

function validateCode(code) {
  var re = /^[a-zA-Z0-9]{4,50}_[a-zA-Z0-9]{10,20}$/;
  return re.test(code);
}

function validateTextarea(text) {
  var re = /^[a-zA-ZåäöüéëïóáíñúÅÄÖßÜÉËÏÓÁÍÑÚ0-9 !@#\$%\^\&*+=._-]{5,255}$/;
  return re.test(text);
}

function validatePhone(phone) {
  var re = /^\+\([0-9]{1,3}\) ?[0-9]{8,10}$/;
  return re.test(phone);
}

function validatePostcode(postcode) {
  var re = /^[a-zA-Z0-9]+(\s[a-zA-Z0-9]*){0,2}$/;
  return re.test(postcode);
}

function validateAddress(address) {
  var re = /^[a-zA-ZåäöüéëïóáíñúÅÄÖßÜÉËÏÓÁÍÑÚ0-9\s.,'-]{5,50}$/;
  return re.test(address);
}

function validateEmail(email) {
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,4}))$/;
  return re.test(email);
}

function validateFullName(name) {
  var re = /^[a-zA-Z0-9åäöüéëïóáíñúÅÄÖßÜÉËÏÓÁÍÑÚ]+(\s[a-zA-Z0-9åäöüéëïóáíñúÅÄÖßÜÉËÏÓÁÍÑÚ]*){0,4}$/;
  return re.test(name);
}

function validateCity(city){
  var re = /^[a-zA-Z0-9åäöüéëïóáíñúÅÄÖßÜÉËÏÓÁÍÑÚ]+(\s[a-zA-Z0-9åäöüéëïóáíñúÅÄÖßÜÉËÏÓÁÍÑÚ]*){0,3}$/;
  return re.test(city);
}

function validatePassword(password) {
  var re = /^(?=.*[a-zåäöüéëïóáíñú])(?=.*[A-ZÅÄÖßÜÉËÏÓÁÍÑÚ])(?=.*[0-9])(?=.{6,})/;
  return re.test(password);
}
