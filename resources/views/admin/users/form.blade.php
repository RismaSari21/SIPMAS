<div class="row g-3">
    <div class="col-md-6"><label class="form-label">Nama</label><input class="form-control" name="name" value="{{ old('name', $user->name) }}" required></div>
    <div class="col-md-6"><label class="form-label">Email</label><input class="form-control" type="email" name="email" value="{{ old('email', $user->email) }}" required></div>
    <div class="col-md-6"><label class="form-label">Nomor HP</label><input class="form-control" name="phone" value="{{ old('phone', $user->phone) }}"></div>
    <div class="col-md-6"><label class="form-label">Role</label><select class="form-select" name="role" required><option value="admin" @selected(old('role',$user->role)==='admin')>Admin</option><option value="masyarakat" @selected(old('role',$user->role ?: 'masyarakat')==='masyarakat')>Masyarakat</option></select></div>
    <div class="col-12"><label class="form-label">Alamat</label><textarea class="form-control" name="address" rows="3">{{ old('address', $user->address) }}</textarea></div>
    <div class="col-md-6"><label class="form-label">Password {{ $user->exists ? '(kosongkan jika tidak diubah)' : '' }}</label><input class="form-control" type="password" name="password" @if(! $user->exists) required @endif></div>
    <div class="col-md-6"><label class="form-label">Konfirmasi Password</label><input class="form-control" type="password" name="password_confirmation" @if(! $user->exists) required @endif></div>
    <div class="col-12"><label class="form-label">Foto</label><input class="form-control" type="file" name="photo" accept="image/*"></div>
</div>
<hr>
