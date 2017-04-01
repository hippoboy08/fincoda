$(document).ready(function(){
  $('.confirmation').on('click', function () {
    return confirm('Are you sure?');
  });

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
    if(countEvaluator() < 5)
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
    if(countEvaluator() > 5)
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

  //add template description to every survey
  var description = "Innovation deals with knowledge-based competitive advantage. The FINCODA barometer gives an overview of a person's level of innovativeness. Innovation is a process that allows for the introduction of a new product or service, new production methods, opens up new markets, identifies new suppliers, and business or management models that result in enhanced performance by, or within, the organization. Therefore, innovation starts with the generation of new ideas and finishes with the use or commercial exploitation of the outcomes.<br>Innovation competencies can be defined as those motivations, attitudes, values, behavior characteristics, individual qualities, cognitive or practical skills that are needed for a successful innovation. The following five dimensions are measured with the FINCODA barometer: creativity, critical thinking, initiative, teamwork and networking. Successful innovation is in many cases a team effort. Therefore, one cannot expect each individual to show a high mastery on all five innovation competencies. Accordingly, an n innovator is defined as someone who has a high mastery on one or more of the basic innovation competencies.";

  $("textarea#editor1").val(description);

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
  var re = /^[a-zA-Z0-9 !@#\$%\^\&*+=._-]{5,255}$/;
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
  var re = /^[a-zA-Z0-9\s.,'-]{5,50}$/;
  return re.test(address);
}

function validateEmail(email) {
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,4}))$/;
  return re.test(email);
}

function validateFullName(name) {
  var re = /^[a-zA-Z0-9ä]+(\s[a-zA-Z0-9]*){0,4}$/;
  return re.test(name);
}

function validateCity(city){
  var re = /^[a-zA-Z0-9]+(\s[a-zA-Z0-9]*){0,3}$/;
  return re.test(city);
}

function validatePassword(password) {
  var re = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{6,})/;
  return re.test(password);
}
