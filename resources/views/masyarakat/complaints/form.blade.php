<div class="row g-3">

    <div class="col-md-8">
        <label class="form-label">Judul Pengaduan</label>
        <input
            type="text"
            class="form-control"
            name="title"
            value="{{ old('title', $complaint->title) }}"
            required>
    </div>

    <div class="col-md-4">
        <label class="form-label">Kategori</label>
        <select class="form-select" name="category_id" required>
            <option value="">Pilih Kategori</option>
            @foreach($categories as $category)
                <option
                    value="{{ $category->id }}"
                    @selected(old('category_id', $complaint->category_id) == $category->id)>
                    {{ $category->category_name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <label class="form-label">Provinsi</label>
        <select id="province_id" class="form-select" name="province_id" required></select>

        <input
            type="hidden"
            id="province_name"
            name="province_name"
            value="{{ old('province_name', $complaint->province_name) }}">
    </div>

    <div class="col-md-3">
        <label class="form-label">Kabupaten / Kota</label>
        <select id="regency_id" class="form-select" name="regency_id" required></select>

        <input
            type="hidden"
            id="regency_name"
            name="regency_name"
            value="{{ old('regency_name', $complaint->regency_name) }}">
    </div>

    <div class="col-md-3">
        <label class="form-label">Kecamatan</label>
        <select id="district_id" class="form-select" name="district_id" required></select>

        <input
            type="hidden"
            id="district_name"
            name="district_name"
            value="{{ old('district_name', $complaint->district_name) }}">
    </div>

    <div class="col-md-3">
        <label class="form-label">Kelurahan / Desa</label>
        <select id="village_id" class="form-select" name="village_id" required></select>

        <input
            type="hidden"
            id="village_name"
            name="village_name"
            value="{{ old('village_name', $complaint->village_name) }}">
    </div>

    <div class="col-12">
        <label class="form-label">Alamat Lengkap</label>

        <textarea
            class="form-control"
            name="address"
            rows="3"
            required>{{ old('address', $complaint->address) }}</textarea>
    </div>

    <div class="col-12">

        <div class="d-flex justify-content-between align-items-center mb-2">
            <label class="form-label mb-0">
                Titik Lokasi pada Peta
            </label>

            <button
                type="button"
                class="btn btn-outline-secondary btn-sm"
                id="use-current-location">
                Gunakan Lokasi Saya
            </button>
        </div>

        <div
            id="map-picker"
            class="map-picker"
            style="height:400px;">
        </div>

    </div>

    <div class="col-md-6">
        <label class="form-label">Latitude</label>

        <input
            id="latitude"
            type="text"
            class="form-control"
            name="latitude"
            value="{{ old('latitude', $complaint->latitude) }}"
            readonly
            required>
    </div>

    <div class="col-md-6">
        <label class="form-label">Longitude</label>

        <input
            id="longitude"
            type="text"
            class="form-control"
            name="longitude"
            value="{{ old('longitude', $complaint->longitude) }}"
            readonly
            required>
    </div>

    <div class="col-md-6">
        <label class="form-label">Foto Bukti</label>

        <input
            type="file"
            class="form-control"
            name="photo"
            accept="image/*">
    </div>

    <div class="col-md-6">
        <label class="form-label">Tanggal Kejadian</label>

        <input
            type="date"
            class="form-control"
            name="complaint_date"
            value="{{ old('complaint_date', optional($complaint->complaint_date)->format('Y-m-d')) }}"
            required>
    </div>

    <div class="col-12">
        <label class="form-label">Deskripsi Pengaduan</label>

        <textarea
            class="form-control"
            name="description"
            rows="5"
            required>{{ old('description', $complaint->description) }}</textarea>
    </div>

</div>

<hr>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    if (typeof window.initWilayahDropdowns === 'function') {

        window.initWilayahDropdowns({
            province_id: "{{ old('province_id', $complaint->province_id) }}",
            regency_id: "{{ old('regency_id', $complaint->regency_id) }}",
            district_id: "{{ old('district_id', $complaint->district_id) }}",
            village_id: "{{ old('village_id', $complaint->village_id) }}"
        });

    }

    if (typeof window.initLocationPicker === 'function') {

        window.initLocationPicker({
            latitude: "{{ old('latitude', $complaint->latitude) }}",
            longitude: "{{ old('longitude', $complaint->longitude) }}"
        });

    }

});
</script>
@endpush