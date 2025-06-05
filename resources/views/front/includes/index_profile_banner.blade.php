<!-- Profile Section -->
<div class="profile-banner mb-5 position-relative">
    <!-- Logout Button -->
    <a href="/user-logout" class="btn btn-sm btn-danger position-absolute" style="top: 15px; right: 15px; z-index: 10;">
        Logout
    </a>

    <!-- Profile Image -->
    <img src="{{ $settings['docs_showcase_profile_image_path'] ?? asset('assets/images/blank.png') }}" class="profile-img"
        alt="Profile" />
</div>
