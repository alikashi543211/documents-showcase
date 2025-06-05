<!-- Footer Section -->
<footer class="bg-light border-top py-4" style="background: #fef6e4; border-color: #f3722c;">
    <div class="container text-center">
        <p class="mb-2 fw-semibold" style="color: #2f2f2f; opacity: 0.7; margin-bottom: 0.25rem;">
            {!! $settings['docs_showcase_footer_copyright_text'] ?? '-----' !!}
        </p>
        <a href="{{ $settings['docs_showcase_footer_website_link'] ?? '#' }}" target="_blank"
            class="text-decoration-none fw-medium" style="color: #f3722c;">
            {{ $settings['docs_showcase_footer_website_link_text'] ?? '#' }}
        </a>
    </div>
</footer>
