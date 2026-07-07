import './bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap-icons/font/bootstrap-icons.css';
import 'datatables.net-bs5/css/dataTables.bootstrap5.min.css';
import 'datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css';
import 'leaflet/dist/leaflet.css';
import '../css/app.css';

import * as bootstrap from 'bootstrap';
import Swal from 'sweetalert2';
import Chart from 'chart.js/auto';
import DataTable from 'datatables.net-bs5';
import 'datatables.net-responsive-bs5';
import L from 'leaflet';
import Alpine from 'alpinejs';

window.bootstrap = bootstrap;
window.Swal = Swal;
window.Chart = Chart;
window.DataTable = DataTable;
window.L = L;
window.Alpine = Alpine;

Alpine.start();

const chartPalette = ['#ff6f61', '#d8a7b1', '#f7cac9', '#8f5668', '#f59e0b', '#22c55e', '#ef4444', '#64748b'];
window.chartPalette = chartPalette;

window.initDataTables = () => {
    document.querySelectorAll('[data-datatable]').forEach((table) => {
        if (!table.dataset.initialized) {
            new DataTable(table, { responsive: true, pageLength: 10, order: [] });
            table.dataset.initialized = 'true';
        }
    });
};

window.confirmDelete = (form) => {
    Swal.fire({
        title: 'Hapus data?',
        text: 'Data yang dihapus tidak dapat dikembalikan.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ff6f61',
        cancelButtonColor: '#64748b',
        confirmButtonText: 'Ya, hapus',
        cancelButtonText: 'Batal',
    }).then((result) => {
        if (result.isConfirmed) form.submit();
    });
};

window.showFlash = (type, message) => {
    if (!message) return;
    Swal.fire({ icon: type, title: message, timer: 2200, showConfirmButton: false });
};

window.initWilayahDropdowns = async (config = {}) => {
    const province = document.querySelector('#province_id');
    const regency = document.querySelector('#regency_id');
    const district = document.querySelector('#district_id');
    const village = document.querySelector('#village_id');
    if (!province || !regency || !district || !village) return;

    const hiddenNames = {
        province: document.querySelector('#province_name'),
        regency: document.querySelector('#regency_name'),
        district: document.querySelector('#district_name'),
        village: document.querySelector('#village_name'),
    };

    const load = async (select, url, selected = null) => {
        select.innerHTML = '<option value="">Memuat...</option>';
        try {
            const response = await fetch(url);
            const items = await response.json();
            select.innerHTML = '<option value="">Pilih</option>';
            items.forEach((item) => {
                const option = new Option(item.name, item.id);
                if (String(item.id) === String(selected)) option.selected = true;
                select.add(option);
            });
        } catch (error) {
            select.innerHTML = '<option value="">Gagal memuat data</option>';
        }
    };

    const setName = (select, target) => {
        if (target) target.value = select.options[select.selectedIndex]?.text || '';
    };

    await load(province, '/wilayah/provinces', config.province_id);
    if (config.province_id) await load(regency, `/wilayah/regencies/${config.province_id}`, config.regency_id);
    if (config.regency_id) await load(district, `/wilayah/districts/${config.regency_id}`, config.district_id);
    if (config.district_id) await load(village, `/wilayah/villages/${config.district_id}`, config.village_id);
    Object.entries(hiddenNames).forEach(([key, input]) => setName({ province, regency, district, village }[key], input));

    province.addEventListener('change', async () => {
        setName(province, hiddenNames.province);
        district.innerHTML = village.innerHTML = '<option value="">Pilih</option>';
        await load(regency, `/wilayah/regencies/${province.value}`);
    });
    regency.addEventListener('change', async () => {
        setName(regency, hiddenNames.regency);
        village.innerHTML = '<option value="">Pilih</option>';
        await load(district, `/wilayah/districts/${regency.value}`);
    });
    district.addEventListener('change', async () => {
        setName(district, hiddenNames.district);
        await load(village, `/wilayah/villages/${district.value}`);
    });
    village.addEventListener('change', () => setName(village, hiddenNames.village));
};

window.initLocationPicker = (config = {}) => {
    const element = document.querySelector('#map-picker');
    const latInput = document.querySelector('#latitude');
    const lngInput = document.querySelector('#longitude');
    if (!element || !latInput || !lngInput) return;

    const start = [Number(config.latitude || -2.5489), Number(config.longitude || 118.0149)];
    const zoom = config.latitude && config.longitude ? 14 : 5;
    const map = L.map(element).setView(start, zoom);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors',
    }).addTo(map);

    let marker = null;
    const setPoint = (latlng) => {
        latInput.value = Number(latlng.lat).toFixed(7);
        lngInput.value = Number(latlng.lng).toFixed(7);
        if (!marker) {
            marker = L.marker(latlng, { draggable: true }).addTo(map);
            marker.on('dragend', () => setPoint(marker.getLatLng()));
        } else {
            marker.setLatLng(latlng);
        }
    };

    if (config.latitude && config.longitude) setPoint({ lat: start[0], lng: start[1] });
    map.on('click', (event) => setPoint(event.latlng));

    document.querySelector('#use-current-location')?.addEventListener('click', () => {
        navigator.geolocation?.getCurrentPosition((position) => {
            const latlng = { lat: position.coords.latitude, lng: position.coords.longitude };
            map.setView(latlng, 15);
            setPoint(latlng);
        });
    });
};

document.addEventListener('DOMContentLoaded', () => {
    window.initDataTables();
});
