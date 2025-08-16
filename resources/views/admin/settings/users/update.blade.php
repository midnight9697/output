@extends('layout.app')

@section('main_content')
    @php
        use App\Models\Division;
        use App\Models\Section;
        use App\Models\Unit;
    @endphp
    <style>
        .custom-outline {
            border-radius: 7px;
        }
    </style>
    <div class="ui aligned grid">
        <div class="eight wide column">
            <div class="ui segment">
                <form class="ui form" action="#" id="formUpdateUser" method="post">
                    <h4 class="ui dividing header">UPDATE - {{ strtoupper($user->full_name) }}</h4>
                    <div class="ui error message">
                        {{--  --}}
                    </div>
                    <div class="field">
                        <div class="two fields">
                            <div class="field">
                                <label>Firstname</label>
                                <input type="text" value="{{ $user->profile->firstname }}" name="firstname" id="firstname" placeholder="Firstname">
                            </div>
                            <div class="field">
                                <label>Middlename</label>
                                <input type="text" value="{{ ($user->profile->middlename=="waived"?"":$user->profile->middlename) }}" name="middlename" id="middlename" placeholder="Middlename">
                            </div>
                            <div class="field">
                                <label>Lastname</label>
                                <input type="text" value="{{ $user->profile->lastname }}" name="lastname" id="lastname" placeholder="Lastname">
                            </div>
                            <div class="field">
                                <label>Suffix</label>
                                <input type="text" value="{{ $user->profile->suffix }}" name="suffix" id="suffix" placeholder="Suffix">
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <label>Email</label>
                        <div class="field">
                            <input type="email" value="{{ $user->email }}" id="email" name="email" placeholder="Email">
                        </div>
                    </div>
                    <div class="field">
                        <label>Position</label>
                        <input type="text" value="{{ $user->profile->position }}" name="position" id="position" placeholder="Position">
                    </div>
                    <div class="field">
                        <div class="two fields">
                            <div class="field">
                                <label>Password</label>
                                <input type="password" name="password" id="password" placeholder="Passsword">
                            </div>
                            <div class="field">
                                <label for="Password Confirm">Password Confirm</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Password Confirm">
                            </div>
                        </div>
                    </div>
                    <div class="inline field">
                        <div class="ui checkbox">
                            <input type="checkbox" name="show_password" id="show_password">
                            <label>Show Password</label>
                        </div>
                    </div>
                    <div class="field">
                        <label>Division</label>
                        <select name="division" id="division" class="ui fluid dropdown">
                            @foreach (Division::get() as $division)
                                <option {{ $division->id == $user->profile->division_id?"selected":"" }} value="{{ $division->id }}">{{ $division->division }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="field">
                        <div class="two fields">
                            <div class="field">
                                <label>Section</label>
                                <select name="section" id="section" class="ui fluid dropdown">
                                    @foreach (Section::where('division_id', $user->profile->division->id)->get() as $section)
                                        <option {{ $section->id == $user->profile->section->id?"selected":"" }} value="{{ $section->id }}">{{ $section->section }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="field">
                                <label>Unit</label>
                                <select name="unit" id="unit" class="ui fluid dropdown">
                                    <option value="">--</option>
                                    @foreach (Unit::where('section_id', $user->profile->section_id)->get() as $unit)
                                        <option {{ $unit->id == $user->profile->unit_id?"selected":"" }} value="{{ $unit->id }}">{{ $unit->unit_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <label>Role</label>
                        <select name="role" id="role" class="ui fluid dropdown" required>
                            <option {{$user->role=="admin"?"selected":"" }} value="admin">ADMIN</option>
                            <option {{$user->role=="user"?"selected":"" }} value="user">USER</option> 
                        </select>
                    </div>
                    <div class="ui divider"></div>
                    <div class="ui right aligned grid">
                        <div class="wide column">
                            <button class="ui tiny button positive" id="save_changes_button">SAVE CHANGES</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="eight wide column">
            <div class="ui segment">
                <h4 class="ui dividing header">{{ strtoupper($user->profile->section->section) }}</h4>
                <div class="ui inverted segment">
                    @foreach ($mates as $mate)
                    <div class="ui inverted relaxed divided list">
                        <div class="item">
                          <div class="content">
                            <div class="header">{{ $mate->user->full_name}}</div>
                            {{ $mate->position }}
                          </div>
                        </div>
                      </div>
                    @endforeach
                  </div>
            </div>
        </div>
    </div>
@endsection

@section('custom_js')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        localStorage.setItem('user', "{{ $user->id }}");
    });
</script>
@vite(['resources/js/User/update.js'])
@endsection