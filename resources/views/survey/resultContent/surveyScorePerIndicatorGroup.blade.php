<table id="indicator_group_average_scores" class="table table-bordered table-striped text-center">
  <h4><b>Dimension Table</b></h4>
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
          <td>{!! $result->Indicator_Group_Average !!}</td>
        </tr>
      @endforeach
    @endif
  </tbody>
</table>
