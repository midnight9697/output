@extends('layout.app')

@section('content')
    <div class="ui container">
        <table class="ui table">
            <thead>
                <tr>
                    <th>Division</th>
                    <th>Sections</th>
                    <th>Employees</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($divisions as $division)
                    <tr>
                        <td>{{ $division->division }}</td>
                        <td>{{ 4 }}</td>
                        <td>{{ 55 }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
@endsection

@section('custom_js')
    
@endsection