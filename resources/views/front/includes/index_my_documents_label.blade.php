<!-- Header -->
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="fw-bold" style="color: #f3722c;">📁 {{ $settings['docs_showcase_heading_text'] ?? '-----' }}</h1>
    </h5>
    <div class="form-check form-switch d-flex align-items-center">
        <input class="form-check-input custom-switch" type="checkbox" id="selectAll">
        <label class="form-check-label ms-2 fw-semibold" for="selectAll" style="color: #2f2f2f;">Select All</label>
    </div>
</div>

<!-- Include in <style> -->
<style>
    .form-check-input.custom-switch {
        width: 3rem;
        height: 1.5rem;
        background-color: #ccc;
        border: 1px solid #ccc;
        transition: all 0.3s ease;
    }

    .form-check-input.custom-switch:checked {
        background-color: #43aa8b;
        border-color: #43aa8b;
    }

    .form-check-input.custom-switch:focus {
        box-shadow: 0 0 0 0.2rem rgba(67, 170, 139, 0.25);
    }
</style>
