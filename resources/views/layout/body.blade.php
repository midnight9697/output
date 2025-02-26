{{-- <div class="ui fixed inverted menu">
    <div class="ui container">
        <a class="launch icon item">
            <i class="content icon"></i>
          </a>
        <div class="item">
            <div class="header">
                Motorcycle
            </div>
        </div>
    </div>
</div> --}}

<div class="pusher">
    <div class="full height">
        <div class="ui simple sidebar inverted vertical menu visible" id="ui_sidebar">
            <div class="item">
                <a class="ui medium image" style="display:flex;justify-content:center">
                    <img src="{{ url('files/images/emb logo.jpg') }}" style="height:50px;margin:auto">
                    <h3 style="margin:auto">EMB SYSTEM</h3>
                </a>
            </div>
            <div class="item">
                <div class="header">System</div>
                <div class="menu">
                   <a href="#" class="item">Cars</a>
                   <a href="#" class="item">Motorcycles</a>
                </div>
            </div>
            <div class="item">
                <div class="header">Settings</div>
                <div class="menu">
                    <a href="#" class="item">Users</a>
                    <a href="{{ url('divisions') }}" class="item">Divisions</a>
                    <a href="#" class="item">Sections</a>
                </div>
            </div>
        </div>
        <div class="article">
            <div class="ui masthead vertical tab segment" style="border: 1px; padding-bottom:0px">
                <div class="ui container">
                    <div class="introduction">
                        <h1 class="header">Division</h1>
                        <div class="sub header">EMB8 DIVISIONS</div>
                        <div class="ui hidden divider"></div>
                    </div>
                </div>
            </div>
            <div class="main ui container" style="padding-top: 10px">
                @yield('content')
            </div>
        </div>
    </div>
</div>

{{-- <div class="pusher">
    <!-- Site content !-->
    <div class="full height">
        @yield('content')
    </div>
</div> --}}
