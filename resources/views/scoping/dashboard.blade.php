@extends('scoping.app')

@section('main_content')
@include('scoping.modal')
<section class="ui segment">
    <div class="stats">
        <a href="{{ url('eia_corner/scoping') }}" class="card">
          <h3>PUBLIC SCOPING</h3>
          <div class="change success">{{ $ps_count }}</div>
        </a>
        <a href="#" class="card">
          <h3>PUBLIC HEARING</h3>
          <div class="change success">0</div>
        </a>
    </div>
</section>
@endsection