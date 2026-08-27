{{-- External Fonts & Icons --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

{{-- Your Existing Plugin CSS --}}
<link rel="stylesheet" href="{{ url('plugins/new/datatables/css/semantic.min.css') }}">
<link rel="stylesheet" href="{{ url('plugins/new/datatables/css/dataTables.semanticui.css') }}">
<link rel="stylesheet" href="{{ url('plugins/new/datatables/css/buttons.semanticui.css') }}">
<link rel="stylesheet" href="{{ url('plugins/new/datatables/css/select.semanticui.css') }}">
<link rel="stylesheet" href="{{ url('plugins/new/datatables/css/dataTables.dateTime.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('plugins/semantic/semantic.min.css')}}">

{{-- Enhanced Custom CSS --}}
<link rel="stylesheet" href="{{ asset('css/enhanced.css') }}">

{{-- Vite CSS --}}
@vite('resources/css/enhanced.css')