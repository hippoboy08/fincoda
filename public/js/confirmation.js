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


  var description = "Innovation deals with knowledge-based competitive advantage. The FINCODA barometer gives an overview of a person's level of innovativeness. Innovation is a process that allows for the introduction of a new product or service, new production methods, opens up new markets, identifies new suppliers, and business or management models that result in enhanced performance by, or within, the organization. Therefore, innovation starts with the generation of new ideas and finishes with the use or commercial exploitation of the outcomes.<br>Innovation competencies can be defined as those motivations, attitudes, values, behavior characteristics, individual qualities, cognitive or practical skills that are needed for a successful innovation. The following five dimensions are measured with the FINCODA barometer: creativity, critical thinking, initiative, teamwork and networking. Successful innovation is in many cases a team effort. Therefore, one cannot expect each individual to show a high mastery on all five innovation competencies. Accordingly, an n innovator is defined as someone who has a high mastery on one or more of the basic innovation competencies.";

  $("textarea#editor1").val(description);

});
