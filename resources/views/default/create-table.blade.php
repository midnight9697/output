<table class="ui very basic collapsing celled table hidden {{ $name }}" id="{{ $name }}" style="width: 100%">
  <thead>
      <tr>
          @foreach ($columns as $column)
              <th>{{ $column }}</th>
          @endforeach
      </tr>
  </thead>
  <tbody style="text-align: center">
      <tr>
          <td colspan="{{ count($columns) }}" class="center aligned">Loading...</td>
      </tr>
  </tbody>
</table>