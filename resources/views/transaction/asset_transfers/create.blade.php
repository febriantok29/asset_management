@extends('layouts.app')

@section('title', 'Tambah Transfer Aset')

@section('page_title', 'Tambah Transfer Aset')

@section('breadcrumb')
    <li class="breadcrumb-item active">Tambah Transfer</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('asset_transfers.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i>
                Kembali</a>
        </div>
        <div class="card-body">
            <form action="{{ route('asset_transfers.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="transfer_date" class="form-label">Tanggal Transfer <span
                                class="text-danger">*</span></label>
                        <input type="date" name="transfer_date" id="transfer_date"
                            class="form-control @error('transfer_date') is-invalid @enderror"
                            value="{{ old('transfer_date', now()->format('Y-m-d')) }}" max="{{ now()->format('Y-m-d') }}"
                            required>
                        @error('transfer_date')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="quantity" class="form-label">Jumlah <span class="text-danger">*</span></label>
                        <input type="number" name="quantity" id="quantity"
                            class="form-control @error('quantity') is-invalid @enderror" value="{{ old('quantity') }}"
                            min="1" required>
                        @error('quantity')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="asset_id" class="form-label">Aset <span class="text-danger">*</span></label>
                    <select name="asset_id" id="asset_id" class="form-control @error('asset_id') is-invalid @enderror"
                        required>
                        <option value="">-- Pilih Aset --</option>
                        @foreach ($assets as $asset)
                            <option value="{{ $asset->id }}" {{ old('asset_id') == $asset->id ? 'selected' : '' }}>
                                {{ $asset->name }}</option>
                        @endforeach
                    </select>
                    @error('asset_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="from_location_id" class="form-label">Dari Lokasi <span
                                class="text-danger">*</span></label>
                        <select id="from_location_id" class="form-control @error('from_location_id') is-invalid @enderror"
                            disabled>
                            <option value="">-- Pilih Lokasi --</option>
                            @foreach ($locations as $location)
                                <option value="{{ $location->id }}"
                                    {{ old('from_location_id') == $location->id ? 'selected' : '' }}>{{ $location->name }}
                                </option>
                            @endforeach
                        </select>
                        <input type="hidden" name="from_location_id" id="hidden_from_location_id"
                            value="{{ old('from_location_id') }}">
                        @error('from_location_id')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="to_location_id" class="form-label">Ke Lokasi <span class="text-danger">*</span></label>
                        <select name="to_location_id" id="to_location_id"
                            class="form-control @error('to_location_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Lokasi --</option>
                            @foreach ($locations as $location)
                                <option value="{{ $location->id }}"
                                    {{ old('to_location_id') == $location->id ? 'selected' : '' }}>{{ $location->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('to_location_id')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                        rows="3">{{ old('description') }}</textarea>
                    @error('description')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                    </div>
                    </div>
                </div>

                </div>
                </div>

                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const assetDropdown = document.getElementById('asset_id');
            const fromLocationDropdown = document.getElementById('from_location_id');
            const hiddenFromLocationInput = document.getElementById('hidden_from_location_id');
            const toLocationDropdown = document.getElementById('to_location_id');

            /**
             * Validate if fromLocation and toLocation are the same.
             */
            function validateLocations() {
                const fromLocationId = fromLocationDropdown.value;
                const toLocationId = toLocationDropdown.value;

                if (fromLocationId && toLocationId && fromLocationId === toLocationId) {
                    alert('Lokasi asal dan tujuan tidak boleh sama.');
                    toLocationDropdown.value = '';
                }
            }

            function resetToLocationOptions() {
                Array.from(toLocationDropdown.options).forEach(option => {
                    option.style.display = 'block';
                });
            }

            function filterToLocationOptions(fromLocationId) {
                Array.from(toLocationDropdown.options).forEach(option => {
                    option.style.display = option.value === fromLocationId ? 'none' : 'block';
                });
            }

            async function updateFromLocation(assetId) {
                try {
                    const response = await fetch(`/get-asset-location/${assetId}`);
                    const data = await response.json();

                    if (data.from_location_id) {
                        fromLocationDropdown.value = data.from_location_id;
                        hiddenFromLocationInput.value = data.from_location_id;
                        fromLocationDropdown.disabled = true;
                        toLocationDropdown.value = '';
                        filterToLocationOptions(data.from_location_id);
                    } else {
                        fromLocationDropdown.value = '';
                        hiddenFromLocationInput.value = '';
                        fromLocationDropdown.disabled = false;
                        resetToLocationOptions();
                    }
                } catch (error) {
                    console.error('Error fetching asset location:', error);
                    fromLocationDropdown.value = '';
                    hiddenFromLocationInput.value = '';
                    fromLocationDropdown.disabled = false;
                    resetToLocationOptions();
                }
            }

            fromLocationDropdown.addEventListener('change', validateLocations);
            toLocationDropdown.addEventListener('change', validateLocations);
            assetDropdown.addEventListener('change', function() {
                const assetId = this.value;

                if (assetId) {
                    updateFromLocation(assetId);
                } else {
                    fromLocationDropdown.value = '';
                    hiddenFromLocationInput.value = '';
                    fromLocationDropdown.disabled = false;
                    resetToLocationOptions();
                }
            });
        });
    </script>

@endsection
