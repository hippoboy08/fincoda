<h3 style="text-align:center;"><b>Dimension Table</b></h3>
<table id="indicator_group_average_scores_compared_to_statistics_student" class="table table-bordered table-striped text-center">

  <br>
  <thead>
    <tr>
      <th>Dimension</th>
      <!-- <th>Dimension Minimum</th> -->
      <th>Dimension Organisation Average</th>
      <!-- <th>Dimension Maximum</th> -->
      <th>Dimension Statistics Average</th>
    </tr>
  </thead>
  <tbody>
    @if(count($surveyScoreStatistics)==0 || count($surveyScorePerIndicatorGroup)==0)
      <div>You have no surveys results to Display</div>
    @else
        @for ($index = 0; $index < count($surveyScorePerIndicatorGroup); $index++)
          <tr>
            <td>{!! $surveyScoreStatistics[$index]->Dimension_Name !!}</td>
            <td>{!! number_format((float)$surveyScorePerIndicatorGroup[$index]->Indicator_Group_Average,2,'.','') !!}</td>
            <!-- <td>{!! number_format((float)$surveyScoreStatistics[$index]->Minimum_Score,2,'.','') !!}</td> -->
            <td>{!! number_format((float)$surveyScoreStatistics[$index]->Average_Score,2,'.','') !!}</td>
            <!-- <td>{!! number_format((float)$surveyScoreStatistics[$index]->Maximum_Score,2,'.','') !!}</td> -->
          </tr>
        @endfor
    @endif
  </tbody>
</table>

<table id="indicator_group_average_scores_compared_to_statistics_professional" class="table table-bordered table-striped text-center">
  <!-- <h3 style="text-align:center;"><b>Dimension Table</b></h3> -->
  <br>
  <thead>
    <tr>
      <th>Dimension</th>
      <!-- <th>Dimension Minimum</th> -->
      <th>Dimension Organisation Average</th>
      <!-- <th>Dimension Maximum</th> -->
      <th>Dimension Statistics Average</th>
    </tr>
  </thead>
  <tbody>
    @if(count($surveyScoreStatistics)==0 || count($surveyScorePerIndicatorGroup)==0)
      <div>You have no surveys results to Display</div>
    @else
        @for ($index = 0; $index < count($surveyScorePerIndicatorGroup); $index++)
          <tr>
            <td>{!! $surveyScoreStatistics[$index]->Dimension_Name !!}</td>
            <td>{!! number_format((float)$surveyScorePerIndicatorGroup[$index]->Indicator_Group_Average,2,'.','') !!}</td>
            <!-- <td>{!! number_format((float)$surveyScoreStatistics[$index]->Minimum_Score,2,'.','') !!}</td> -->
            <td>{!! number_format((float)$surveyScoreStatistics[$index + 5]->Average_Score,2,'.','') !!}</td>
            <!-- <td>{!! number_format((float)$surveyScoreStatistics[$index]->Maximum_Score,2,'.','') !!}</td> -->
          </tr>
        @endfor
    @endif
  </tbody>
</table>
