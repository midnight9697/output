<header>
    <div class="header">
        {{-- <img src="{{  public_path('denr-emb-logo.png') }}" alt="Logo" class="logo left"/> --}}
        <div class="header-text">
            <h3 class="header-three">Republic of the Philippines</h3>
            <h3 class="header-three">Department of Environment and Natural Resources</h3>
            <h3 class="header-three header-emb-line">ENVIRONMENTAL MANAGEMENT BUREAU</h3>
            <h3 class="header-three region-eight-line">Regional Office VIII</h3>
        </div>
        {{-- <img src="{{  public_path('Bagong_Pilipinas_logo.jpg') }}" alt="Logo" class="logo right"/> --}}
    </div>
    <div class="blue-line"></div>
</header>

<style>
    .header {
        display: flex;
        align-items: center;
        margin: 0px;
        font-size: 12px;
    }

    .header-three {
      margin: 0px;
    }

    .blue-line {
      border: solid blue 5px;
    }
    
    .header-emb-line {
      color: blue;
    }

    .logo {
        height: auto;
        padding-top:5px;
        padding-bottom:5px;
    }

    .left {
      width: 100px;
      margin-left: 20px;
    }

    .right {
      width: 100px;
      margin-top: -10px;
      margin-right: 20px;
    }

    .header-text {
      text-align: start;
      flex: 1;
    }

    header h2 {
        color: blue;
        margin: 5px 0;
    }

    .region-eight-line {
      color: darkgreen;
      font-weight: normal;
    }

    .title-block {
        text-align: center;
        margin-top: 40px;
        /* padding-top: 50px; */
        font-weight: bold;
        font-size: 11px;
    }
</style>