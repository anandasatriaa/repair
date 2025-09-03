<div class="row">
    <div class="col-md-6 mb-3">
        <label for="item_code" class="form-label">Item Code <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="item_code" value="{{ old('item_code', $sparePart->item_code ?? '') }}" placeholder="e.g., 9.BF3015/6" required>
    </div>
    <div class="col-md-6 mb-3">
        <label for="brand" class="form-label">Brand <span class="text-danger">*</span></label>
        <select class="form-select" id="brand" name="brand" required>
            <option value="" disabled {{ old('brand', $sparePart->brand ?? '') ? '' : 'selected' }}>Choose Brand...</option>
            <option value="RUPES" {{ (old('brand', $sparePart->brand ?? '') == 'RUPES') ? 'selected' : '' }}>RUPES</option>
            <option value="CTEK" {{ (old('brand', $sparePart->brand ?? '') == 'CTEK') ? 'selected' : '' }}>CTEK</option>
            <option value="NOCO" {{ (old('brand', $sparePart->brand ?? '') == 'NOCO') ? 'selected' : '' }}>NOCO</option>
        </select>
    </div>
</div>
<div class="mb-3">
    <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
    <textarea class="form-control" name="description" rows="3" placeholder="e.g., Nylon Soft Cup Brush" required>{{ old('description', $sparePart->description ?? '') }}</textarea>
</div>
<div class="row">
    <div class="col-md-4 mb-3">
        <label for="quantity" class="form-label">Quantity</label>
        <input type="number" class="form-control" name="quantity" value="{{ old('quantity', $sparePart->quantity ?? '') }}" placeholder="e.g., 1 or 125">
    </div>
    <div class="col-md-4 mb-3">
        <label for="unit" class="form-label">Unit (e.g., Pcs, Pair, mm)</label>
        <input type="text" class="form-control" name="unit" value="{{ old('unit', $sparePart->unit ?? '') }}" placeholder="e.g., Pcs">
    </div>
    <div class="col-md-4 mb-3">
        <label for="moq" class="form-label">MOQ</label>
        <input type="number" class="form-control" name="moq" value="{{ old('moq', $sparePart->moq ?? '') }}" placeholder="e.g., 2">
    </div>
</div>