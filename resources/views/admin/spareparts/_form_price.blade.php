<div class="row">
    <div class="col-md-6 mb-3">
        <label for="price" class="form-label">Price <span class="text-danger">*</span></label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="number" class="form-control" name="price" value="{{ old('price') }}" placeholder="e.g., 252000" required>
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <label for="effective_date" class="form-label">Effective Date <span class="text-danger">*</span></label>
        <input type="date" class="form-control" name="effective_date" value="{{ old('effective_date', now()->format('Y-m-d')) }}" required>
    </div>
</div>