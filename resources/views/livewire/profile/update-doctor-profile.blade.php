<x-jet-form-section submit="updateProfile" x-data="{table: false}">


    <x-slot name="title">
        {{ __('Update Doctor Schedule') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update doctor schedule details.') }}
    </x-slot>


    <x-slot name="form">

        <x-jet-action-message on="savedProfile">
            {{ __('Saved.') }}
        </x-jet-action-message>

        @if(session('warning'))
        <div class="alert alert-warning" role="alert">
            {{session('warning')}}
        </div>
        {{Session::forget('warning')}}
        @endif

         @if (session()->has('message-notify'))
            <div class="alert alert-success">
                {{ session('message-notify') }}
            </div>
        @endif


        <div class="row">
            <div class="form-group mb-3 col-md-2">
                <x-jet-label for="saluation" value="{{ __('Saluation') }}" />
                <select class="form-control" wire:model.defer="saluation">
                    <option selected value="" hidden>Select</option>
                    <option>Mr.</option>
                    <option>Mrs.</option>
                    <option>Mast.</option>
                    <option>Miss.</option>
                    <option>Dr.</option>
                    <option>Dr(Mrs).</option>
                    <option>Dr(Ms).</option>
                    <option>Prof.</option>
                    <option>Prof(Mrs).</option>
                    <option>Prof(Ms).</option>
                    <option>Rev.</option>
                    <option>Sis.</option>
                    <option>Hon.</option>
                    <option>Ms.</option>
                    <option>Baby.</option>
                </select>
                <x-jet-input-error for="saluation" />
            </div>

            <!-- Nationality -->
            <div class="mb-3 form-group col-md-3">
                <x-jet-label for="speciality" value="{{ __('Speciality') }}" />
                <select class="form-control @error('speciality') is-invalid  @enderror" wire:model.defer="speciality" id="speciality">
                    <option value="">Select</option>
                    @foreach($specialities as $speciality)
                    <option value="{{$speciality}}">{{$speciality}}</option>
                    @endforeach
                </select>
                <x-jet-input-error for="speciality" />
            </div>

            <div class="mb-3 form-group col-md-3">
                <x-jet-label for="day" value="{{ __('Day') }}" />
                <select class="form-control @error('day') is-invalid  @enderror" wire:model.defer="day" id="day">
                    <option value="">Select</option>
                    <option>Sunday</option>
                    <option>Monday</option>
                    <option>Tuesday</option>
                    <option>Wednesday</option>
                    <option>Thursday</option>
                    <option>Friday</option>
                    <option>Saturday</option>
                </select>
                <x-jet-input-error for="day" />
            </div>

            <div class="mb-3 form-group col-md-3">
                <x-jet-label for="time" value="{{ __('Time') }}" />
                <x-jet-input id="time" type="time" class="{{ $errors->has('time') ? 'is-invalid' : '' }}" wire:model.defer="time"  />
                <x-jet-input-error for="time" />
            </div>

            <!-- Fees -->
            <div class="mb-3 form-group col-md-3">
                <x-jet-label for="fees" value="{{ __('Fees') }}" /><small>(In LKR)</small>
                <x-jet-input id="fees" type="text" class="{{ $errors->has('fees') ? 'is-invalid' : '' }}" wire:model.defer="fees"  />
                <x-jet-input-error for="fees" />
            </div>
        </div>





    </x-slot>

    <x-slot name="actions">

            <x-jet-button class="app-btn-primary">
                <div wire:loading class="spinner-border spinner-border-sm" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>

                {{ __('Save') }}
            </x-jet-button>

    </x-slot>




</x-jet-form-section>

