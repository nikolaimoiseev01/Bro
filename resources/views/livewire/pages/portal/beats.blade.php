<div class="content">
   <h2 class="mb-8">БИТЫ</h2>
    <div class="flex gap-8 flex-wrap">
        @foreach($beats as $beat)
            <livewire:components.portal.track-with-cover :track="$beat"/>
        @endforeach
    </div>
</div>
