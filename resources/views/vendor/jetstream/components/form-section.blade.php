@props(['submit'])

<div {{ $attributes->merge(['class' => 'row g-4 settings-section']) }}>
    <div class="col-12 col-md-5">
       <h4 class="section-title">{{ $title }}</h4>
       <div class="section-intro">{{ $description }}</div>
    </div>

    <div class="col-12 col-md-6">
        <div class="card shadow-sm p-4">                
            <form wire:submit.prevent="{{ $submit }}" class="settings-form">
                <div class="app-card-body"> 
                    
                    {{$form}}
                  
                </div>

                 @if (isset($actions))
                    {{ $actions }}
                 @endif
            </form> 
        </div>
    </div>  
</div>
