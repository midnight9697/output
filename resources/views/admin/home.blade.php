@extends('layout.app')

@section('main_content')
@php
    $lastActivity = strtotime(date('Y-m-d h:m a'));

    // Get the session lifetime in minutes from the configuration
    $sessionLifetimeMinutes = Config::get('session.lifetime');
    
    // Calculate the expiration timestamp
    $expirationTimestamp = $lastActivity + ($sessionLifetimeMinutes * 60);
    
    // Calculate the remaining minutes
    $remainingMinutes = floor(($expirationTimestamp - time()) / 60);
    echo "Remaining session time: " . $remainingMinutes . " minutes.";
@endphp
  <h1 class="ui header">Hello, {{ Auth::user()->full_name }}</h1>
<div class="ui grid stackable padded">
    <div class="four wide computer eight wide tablet sixteen wide mobile column">
        <div class="ui fluid card">
            <div class="content">
                <div class="ui right floated header">
                    <div class="file alternate icon"></div>
                </div>
                <div class="header">
                    <div class="red header">1,000</div>
                </div>
                <div class="meta">Files</div>
                <div class="description">
                    Purchase Request
                </div>
            </div>
            <div class="extra content">
                <a href="#" class="ui fluid button red">More Info</a>
            </div>
        </div>
    </div>
    <div class="four wide computer eight wide tablet sixteen wide mobile column">
        <div class="ui fluid card">
            <div class="content">
                <div class="ui right floated header">
                    <div class="file alternate icon"></div>
                </div>
                <div class="header">
                    <div class="red header">1,000</div>
                </div>
                <div class="meta">Files</div>
                <div class="description">
                    Purchase Order
                </div>
            </div>
            <div class="extra content">
                <a href="#" class="ui fluid button red">More Info</a>
            </div>
        </div>
    </div>

    <div class="four wide computer eight wide tablet sixteen wide mobile column">
        <div class="ui fluid card">
            <div class="content">
                <div class="ui right floated header">
                    <div class="file alternate icon"></div>
                </div>
                <div class="header">
                    <div class="red header">1,000</div>
                </div>
                <div class="meta">Files</div>
                <div class="description">
                    Members
                </div>
            </div>
            <div class="extra content">
                <a href="#" class="ui fluid button red">More Info</a>
            </div>
        </div>
    </div>
    
    <div class="four wide computer eight wide tablet sixteen wide mobile column">
        <div class="ui fluid card">
            <div class="content">
                <div class="ui right floated header">
                    <div class="file alternate icon"></div>
                </div>
                <div class="header">
                    <div class="red header">1,000</div>
                </div>
                <div class="meta">Files</div>
                <div class="description">
                    BAC
                </div>
            </div>
            <div class="extra content">
                <a href="#" class="ui fluid button red">More Info</a>
            </div>
        </div>
    </div>
</div>
@endsection
@section('custom_js')
    @vite(['resources/js/home.js'])
@endsection