<div class="py-4 w-full">
    <audio id="{{$getState()}}" class="h-8"  controls>
        <source src="{{ $getState() }}" type="audio/ogg">
        <source src="{{ $getState() }}" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var audioElement = document.getElementById('{{$getState()}}');
            audioElement.volume = 0.05; // Установите желаемый уровень громкости от 0.0 до 1.0
        });
    </script>

</div>
