<div class="flex flex-col gap-1 group w-full">
    @if(strlen($text) > 0)
        <label class="text-md font-light" for="">{{$text}}</label>
    @endif
    <div class="relative">
        <input  {{ $attributes->merge(['class' => 'text-sm w-full text-black-main border-transparent focus:border-transparent focus:ring-0 z-10 relative']) }} type="text">
        <div class="absolute top-0 right-0 w-full h-full bg-blue z-1 group-focus-within:-top-0.5 group-focus-within:-right-0.5 transition-all duration-300"></div>
        <div class="absolute top-0 right-0 w-full h-full bg-pink z-0 group-focus-within:-top-1 group-focus-within:-right-1 transition-all duration-300"></div>
    </div>
</div>
