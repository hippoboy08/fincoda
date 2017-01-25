$(document).ready(function(){
    $('.confirmation').on('click', function () {
        return confirm('Are you sure?');
    });

    var description = "Innovation deals with knowledge-based competitive advantage. The FINCODA barometer gives an overview of a person's level of innovativeness. Innovation is a process that allows for the introduction of a new product or service, new production methods, opens up new markets, identifies new suppliers, and business or management models that result in enhanced performance by, or within, the organization. Therefore, innovation starts with the generation of new ideas and finishes with the use or commercial exploitation of the outcomes.<br>Innovation competencies can be defined as those motivations, attitudes, values, behavior characteristics, individual qualities, cognitive or practical skills that are needed for a successful innovation. The following five dimensions are measured with the FINCODA barometer: creativity, critical thinking, initiative, teamwork and networking. Successful innovation is in many cases a team effort. Therefore, one cannot expect each individual to show a high mastery on all five innovation competencies. Accordingly, an n innovator is defined as someone who has a high mastery on one or more of the basic innovation competencies.";

    $("textarea#editor1").val(description);

});
