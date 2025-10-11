<table class="ui very basic collapsing celled table hidden {{ $name }}" id="{{ $name }}" style="width: 100%">
{{-- <table class="ui very basic collapsing celled table hidden {{ $name }}" id="{{ $name }}"> --}}
  <thead>
        @if (isset($headers))
        <tr>
            @foreach ($headers as $column)
                <th colspan="{{ $column->colspan }}" style="text-align: center">{{ $column->name }}</th>
            @endforeach
        </tr>
        @endif
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

