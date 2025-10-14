<form action="#" class="form ui form-create-abstract">
    <div class="ui error message">
        {{--  --}}
    </div>
    <div class="field">
        <label>UPLOAD ABSTRACT FILE</label>
        <input type="file" multiple class="file" id="files" name="files" placeholder="FILE UPLOAD">
    </div>
    <div class="field">
        <label for="purpose">PURPOSE</label>
        <input type="text" placeholder="PURPOSE" name="purpose">
    </div>
    <div class="ui bottom attached segment">
        @include('default.create-table', [ 'name' => 'abstract-items-table',
        'columns' => [
          'REF NO.',
          'PURPOSE',
          'UPLOADED AT'
        ]
      ])
    </div>
</form>