<table class="ui very basic collapsing celled table hidden {{ $name }}" id="{{ $name }}" style="width: 100%">
{{-- <table class="ui very basic collapsing celled table hidden {{ $name }}" id="{{ $name }}"> --}}
  <thead>
      <tr>
          @foreach ($columns as $column)
              <th>{{ $column }}</th>
          @endforeach
      </tr>
  </thead>
  <tbody style="text-align: center" id="{{ (isset($body)?$body:"") }}">
      <tr>
          <td colspan="{{ count($columns) }}" class="center aligned">No Record Found</td>
      </tr>
  </tbody>
</table>

