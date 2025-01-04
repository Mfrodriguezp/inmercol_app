import './bootstrap';
import 'flowbite';
import './../../vendor/power-components/livewire-powergrid/dist/powergrid';
import Swal from 'sweetalert2';
window.Swal = Swal; // Esto lo hace disponible globalmente
// If you use Tailwind 
import './../../vendor/power-components/livewire-powergrid/dist/tailwind.css';

//Datapicker
import flatpickr from "flatpickr";

import TomSelect from "tom-select";
window.TomSelect = TomSelect

