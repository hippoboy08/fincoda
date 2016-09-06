<table id="indicator_group_average_scores" class="table table-bordered table-striped text-center">
  <thead>
    <tr>
      <th>Survey ID</th>
      <th>Indicator Group</th>
      <th>Indicator Group Average</th>
    </tr>
  </thead>
  <tbody>
    @if(count($surveyScorePerIndicatorGroup)==0)
      <div>You have no surveys results to Display</div>
    @else
      @foreach($surveyScorePerIndicatorGroup as $result)
        <tr>
          <td>{!! $result->Survey_ID !!}</td>
          <td>{!! $result->Indicator_Group !!}</td>
          <td>{!! $result->Indicator_Group_Average !!}</td>
        </tr>
      @endforeach
    @endif
  </tbody>
</table>
