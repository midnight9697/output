<table class="ui very basic collapsing celled table hidden {{ $name }}" id="{{ $name }}" style="width: 100%; border-collapse: separate; border-spacing: 0; border-radius: 12px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
  <thead id="{{ (isset($headerId)?$headerId:"") }}" style="background: #f8fafc;">
        @if (isset($headers))
        <tr>
            @foreach ($headers as $column)
                <th colspan="{{ $column->colspan }}" style="text-align: center; padding: 12px 16px; font-weight: 600; color: #0f172a; border-bottom: 2px solid #e2e8f0;">{{ $column->name }}</th>
            @endforeach
        </tr>
        @endif
        <tr>
            @foreach ($columns as $column)
                <th style="padding: 12px 16px; font-weight: 600; color: #1e293b; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 2px solid #e2e8f0;">{{ $column }}</th>
            @endforeach
        </tr>
  </thead>
  <tbody style="text-align: center; background: #ffffff;" id="{{ (isset($body)?$body:"") }}">
      
  </tbody>
</table>