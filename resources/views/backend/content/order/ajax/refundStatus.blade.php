<table class="table table-bordered">
  @foreach ($status as $key => $value)
  <tr>
    <td>{{$key}}</td>
    <td>{{$value}}</td>
  </tr>
  @endforeach
</table>