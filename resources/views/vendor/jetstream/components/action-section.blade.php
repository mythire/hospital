<div {{ $attributes->merge(['class' => 'row g-4 settings-section']) }}>
    <div class="col-md-5">
       <h4 class="section-title">{{ $title }}</h4>
       <div class="section-intro">{{ $description }}</div>       
    </div>

    <div class="col-md-6">
        <div class="card shadow-sm p-4"> 
           <div class="card-body">                     
               {{ $content }}
           </div>
        </div>       
    </div>
</div>
