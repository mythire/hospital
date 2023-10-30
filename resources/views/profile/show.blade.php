<x-app-layout>
    @section('heading', 'Profile Details')
    <hr class="mb-4">

    <div>
        @if (Laravel\Fortify\Features::canUpdateProfileInformation())
            @livewire('profile.update-profile-information-form')

            <x-jet-section-border />
        @endif

        @role('Doctor')
            @livewire('profile.update-doctor-profile')

            <x-jet-section-border />

        @endrole


        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
            @livewire('profile.update-password-form')

            <x-jet-section-border />
        @endif

        @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
            @livewire('profile.two-factor-authentication-form')

            <x-jet-section-border />
        @endif

        @livewire('profile.logout-other-browser-sessions-form')

        @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
            <x-jet-section-border />

            @role('Member|Doctor')

                @livewire('profile.delete-user-form')
            @endrole
        @endif
    </div>
</x-app-layout>
