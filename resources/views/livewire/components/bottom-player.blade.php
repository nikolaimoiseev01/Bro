<div x-data="{volume: true}" id="bp_player_block"
     class="fixed -bottom-28 z-20 left-0 w-full bg-black-grey border-t bg-black-light">
    <div class="content py-4 flex gap-4 items-center relative">

        <x-application-logo class="white small w-40"></x-application-logo>


        <div class="flex flex-col justify-between">
            <p id="bp_artist" class="text-sm">Artist</p>
            <p id="bp_title">Song name 123</p>
        </div>

        <i id="bp_play_pause" class="ph !text-5xl cursor-pointer ph-play-circle"></i>

        <div class="flex-1 flex flex-row items-center gap-2">
            <p class="text-sm min-w-12 w-12 text-end" id="bp_time_cur">0:00</p>

            <div class="flex-1 cursor-pointer" id="bp_player"></div>

            <p class="text-sm min-w-12 w-12" id="bp_time_total"></p>
        </div>


        <i x-show="volume" @click="volume = false" id="bp_volume_up"
           class="ph !text-xl cursor-pointer ph-speaker-high"></i>
        <i x-show="!volume" @click="volume = true" id="bp_volume_down"
           class="ph !text-xl cursor-pointer ph-speaker-none"></i>


        <input id="bp_volume" class="cursor-pointer" type="range" min="0" max="0.3" step="0.001">

    </div>
</div>

@push('script')

    <script>

        // Иницилиизурем
        var initial_volume = 0.1
        var volume_slider = $('#bp_volume')
        var play_pause_button = $('#bp_play_pause')
        var bp_time_cur = $('#bp_time_cur')
        var bp_time_total = $('#bp_time_total')
        var player_id = '#bp_player'
        var pre_volume = 0
        var total_duration = 0

        var wavesurfer;
        var isInitialized = false; // Флаг для отслеживания инициализации
        var track;

        function play_or_create(track_input) {
            // console.log(track ? track.id : 8, track.id, track_input.id)
            if (!track || track.id !== track_input.id) { // Если это новый трек
                track = track_input;
                make_bp_player();
            } else {  // Если это продолжение трека
                play_pause()
            }
        }

        function play_pause() {
            var initial_button = $('#initial_play_pause_' + track.id)

            $('.initial_play_pause').each(function () {
                $(this).removeClass('ph-pause ph-pause-circle')
                $(this).addClass('ph-play ph-play-circle')
            })

            wavesurfer.playPause()

            if (wavesurfer.isPlaying()) {
                play_pause_button.removeClass('ph-play-circle');
                play_pause_button.addClass('ph-pause-circle');
                initial_button.removeClass('ph-play ph-play-circle');
                initial_button.addClass('ph-pause ph-pause-circle');
            } else {
                play_pause_button.addClass('ph-play-circle');
                play_pause_button.removeClass('ph-pause-circle');
                initial_button.addClass('ph-play ph-play-circle');
                initial_button.removeClass('ph-pause ph-pause-circle');
            }
        }

        function formatTime(time) {
            return [
                Math.floor((time % 3600) / 60), // minutes
                ('00' + Math.floor(time % 60)).slice(-2) // seconds
            ].join(':');
        };

        function show_hide_player(mode) {
            // Проверяем, если блок еще не выезжал
            var bpPlayerBlock = $('#bp_player_block');

            if (mode) {
                bpPlayerBlock.css('display', 'block').animate({bottom: '0'}, 500); // Анимация выезда блока
            } else {
                bpPlayerBlock.css('display', 'block').animate({bottom: '-100px'}, 500); // Анимация выезда блока

            }
        }

        function make_bp_player() {

            if (wavesurfer) {
                wavesurfer.destroy()
            }


            function setVolume(volume) {
                wavesurfer.setVolume(volume);
                volume_slider.val(volume);
            }


            $('#bp_artist').html(track.artist_name)
            $('#bp_title').html(track.title)


            wavesurfer = WaveSurfer.create({
                container: player_id,
                waveColor: '#a6a6a6',
                height: 40,
                progressColor: '#59B5E2',
                normalize: true,
            });

            wavesurfer.load(track.mp3);
            setVolume(initial_volume);

            if (!isInitialized) {

                wavesurfer.on('ready', function () {
                    total_duration = formatTime(wavesurfer.getDuration())
                    bp_time_total.html(total_duration)
                });

                wavesurfer.on('timeupdate', (currentTime) => {
                    bp_time_cur.html(formatTime(currentTime))
                })

                wavesurfer.on('finish', () => {
                    // play_pause()
                })

                play_pause_button.on('click', function () {
                    play_pause()
                })

                $('#bp_volume_up').on('click', function () {
                    pre_volume = wavesurfer.getVolume()
                    setVolume(0)
                })

                $('#bp_volume_down').on('click', function () {
                    setVolume(pre_volume)
                })

                volume_slider.on('input', function (e) {
                    setVolume($(this).val())
                })

                isInitialized = true; // Устанавливаем флаг инициализации

                show_hide_player(true)

            }


            play_pause()

        }
    </script>
@endpush
