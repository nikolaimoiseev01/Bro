import './bootstrap';
import WaveSurfer from "wavesurfer.js";
import Swal from "sweetalert2";
import {Notyf} from "notyf";
import 'notyf/notyf.min.css'; // for React, Vue and Svelte


window.WaveSurfer = WaveSurfer;
window.Swal = Swal;
window.notify = new Notyf({})

document.addEventListener('alpine:init', () => {
    Alpine.store('data', {
        showAddTrack: false,
        toggle() {
            this.showAddTrack = !this.showAddTrack
        }
    })
})


Livewire.on('modal_alert', param => {
    Swal.fire({
        title: param.title,
        text: param.message,
        icon: param.icon,
        confirmButtonText: 'OK'
    });
});


Livewire.on('toast', param => {
    console.log(param.type)
    notify.open({
        ripple: false,
        duration: 5000,
        position: {
            x: 'center',
            y: 'botton'
        },
        type: param.type,
        message: param.message
    });
});

Livewire.on('toggle_showAddTrack', param => {
    Alpine.store('data').toggle();
});

