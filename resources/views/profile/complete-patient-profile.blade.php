<x-app-layout>
    @section('heading', 'Update Profile Details')
    <hr class="mb-4">

    <div>
        @role('Member')
            @livewire('profile.update-profile')

            <x-jet-section-border />
        @endrole

    </div>
</x-app-layout>
