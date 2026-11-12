@php $isEdit = $anggota !== null; @endphp

<div class="mb-3">
    <label class="form-label">Nomor Kartu (NIM)</label>
    <input type="text" class="form-control @error('nomor_kartu') is-invalid @enderror" name="nomor_kartu"
           value="{{ old('nomor_kartu', $anggota?->nomor_kartu) }}" {{ $isEdit ? 'disabled' : 'required' }}>
    @error('nomor_kartu')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Nama Anggota</label>
    <input type="text" class="form-control @error('nama_anggota') is-invalid @enderror" name="nama_anggota"
           value="{{ old('nama_anggota', $anggota?->nama_anggota) }}" required>
    @error('nama_anggota')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Email</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
               value="{{ old('email', $anggota?->email) }}">
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">No. HP</label>
        <input type="text" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp"
               value="{{ old('no_hp', $anggota?->no_hp) }}">
        @error('no_hp')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="mb-3">
    <label class="form-label">Alamat</label>
    <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" rows="2">{{ old('alamat', $anggota?->alamat) }}</textarea>
    @error('alamat')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Tipe Keanggotaan</label>
        <select class="form-select @error('tipe_keanggotaan') is-invalid @enderror" name="tipe_keanggotaan" required>
            <option value="">-- pilih --</option>
            @foreach(\App\Models\Anggota::TIPE as $tipe)
                <option value="{{ $tipe }}" @selected(old('tipe_keanggotaan', $anggota?->tipe_keanggotaan) === $tipe)>{{ $tipe }}</option>
            @endforeach
        </select>
        @error('tipe_keanggotaan')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Status ID Card</label>
        <select class="form-select @error('status_id_card') is-invalid @enderror" name="status_id_card" required>
            <option value="">-- pilih --</option>
            @foreach(\App\Models\Anggota::STATUS as $status)
                <option value="{{ $status }}" @selected(old('status_id_card', $anggota?->status_id_card ?? 'Belum Dicetak') === $status)>{{ $status }}</option>
            @endforeach
        </select>
        @error('status_id_card')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Tanggal Daftar</label>
        <input type="date" class="form-control @error('tanggal_daftar') is-invalid @enderror" name="tanggal_daftar"
               value="{{ old('tanggal_daftar', $anggota?->tanggal_daftar?->format('Y-m-d')) }}">
        @error('tanggal_daftar')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Masa Berlaku Kartu</label>
        <input type="date" class="form-control @error('masa_berlaku') is-invalid @enderror" name="masa_berlaku"
               value="{{ old('masa_berlaku', $anggota?->masa_berlaku?->format('Y-m-d')) }}">
        @error('masa_berlaku')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
