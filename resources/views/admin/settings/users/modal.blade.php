@php
    use App\Models\Division;
    use App\Models\Section;
@endphp
<div class="ui modal" id="modalCreate">
    {{-- <div class="header">REGISTER NEW USER</div> --}}
    <div class="content">
        <form class="ui form" action="#" id="formCreateUser" method="post">
            <h4 class="ui dividing header">REGISTER NEW USER</h4>
            <div class="ui error message">
                {{--  --}}
            </div>
            <div class="field">
                <label>Name</label>
                <div class="two fields">
                    <div class="field">
                        <input required type="text" name="firstname" id="firstname" placeholder="Firstname">
                    </div>
                    <div class="field">
                        <input required type="text" name="middlename" id="middlename" placeholder="Middlename">
                    </div>
                    <div class="field">
                        <input required type="text" name="lastname" id="lastname" placeholder="Lastname">
                    </div>
                    <div class="field">
                        <input required type="text" name="suffix" id="suffix" placeholder="Suffix">
                    </div>
                </div>
            </div>
            <div class="field">
                <label>Email</label>
                <div class="field">
                    <input type="email" id="email" name="email" placeholder="Email">
                </div>
            </div>
            <div class="field">
                <label>Position</label>
                <input required type="text" name="position" id="position" placeholder="Position">
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
                <select required name="division" id="division" class="ui fluid dropdown">
                    @foreach (Division::get() as $division)
                        <option value="{{ $division->id }}">{{ $division->division }}</option>
                    @endforeach
                </select>
            </div>
            <div class="field">
                <label>Section/Unit</label>
                <select required name="section" id="section" class="ui fluid dropdown">
                    
                </select>
            </div>
            {{-- <div class="ui active loader"></div> --}}
        </form>
    </div>
    <div class="actions">
        <button type="submit" class="ui primary button" id="createUserFinalize">
            REGISTER USER
        </button>
    </div>
</div>
