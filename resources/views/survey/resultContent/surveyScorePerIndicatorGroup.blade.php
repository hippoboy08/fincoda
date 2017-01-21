<table id="indicator_group_average_scores" class="table table-bordered table-striped text-center">
  <h3 style="text-align:center;"><b>Dimension Table</b></h3>
  <br>
  <thead>
    <tr>
      <th>Dimension</th>
      <th>Dimension Average</th>
    </tr>
  </thead>
  <tbody>
    @if(count($surveyScorePerIndicatorGroup)==0)
      <div>You have no surveys results to Display</div>
    @else
      @foreach($surveyScorePerIndicatorGroup as $result)
        <tr>
          <td>{!! $result->Indicator_Group !!}</td>
          <td>{!! number_format((float)$result->Indicator_Group_Average,2,'.','') !!}</td>
        </tr>
      @endforeach
    @endif
  </tbody>
</table>
