<table id="indicator_group_average_scores" class="table table-bordered table-striped text-center">
  <h3 style="text-align:center;"><b>Dimension Table</b></h3>
  <br>
  <thead>
    <tr>
      <th>Dimension</th>
      <th>Dimension Minimum</th>
      <th>Dimension Average</th>
      <th>Dimension Maximum</th>
    </tr>
  </thead>
  <tbody>
    @if(count($surveyScoreGroupAvgPerIndicatorGroupMinAndMax)==0)
      <div>You have no surveys results to Display</div>
    @else
      @for ($index = 0; $index < count($surveyScoreGroupAvgPerIndicatorGroupMinAndMax); $index++)
        <tr>
          <td>{!! $surveyScoreGroupAvgPerIndicatorGroupMinAndMax[$index]->Indicator_Group !!}</td>
          <td>{!! number_format((float)$surveyScoreGroupAvgPerIndicatorGroupMinAndMax[$index]->Minimum_User_Indicator_Group_Average,2,'.','') !!}</td>
          <td>{!! number_format((float)$surveyScorePerIndicatorGroup[$index]->Indicator_Group_Average,2,'.','') !!}</td>
          <td>{!! number_format((float)$surveyScoreGroupAvgPerIndicatorGroupMinAndMax[$index]->Maximum_User_Indicator_Group_Average,2,'.','') !!}</td>
        </tr>
      @endfor
    @endif
  </tbody>
</table>
