<form action="{{ url('convert-pdf') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file">

    <button type="submit">
        Convert to PDF
    </button>
</form>