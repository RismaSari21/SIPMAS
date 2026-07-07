<div class="mb-3"><label class="form-label">Nama Kategori</label><input class="form-control" name="category_name" value="{{ old('category_name', $category->category_name) }}" required></div>
<div class="mb-3"><label class="form-label">Deskripsi</label><textarea class="form-control" name="description" rows="4">{{ old('description', $category->description) }}</textarea></div>
