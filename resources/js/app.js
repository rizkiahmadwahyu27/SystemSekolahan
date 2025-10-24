import Swal from 'sweetalert2';
import './bootstrap';
import Chart from 'chart.js/auto';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

function showAlert(type, title, text) {
    Swal.fire({
        icon: type,
        title: title,
        text: text,
    });
}
