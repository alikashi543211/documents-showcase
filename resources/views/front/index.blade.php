@include('front.includes.index_header')

<body>

    <div class="container py-4">
        @include('front.includes.index_messages')
        @include('front.includes.index_profile_banner')

        @include('front.includes.index_my_documents_label')

        <!-- Document Grid -->
        <div class="row g-3" id="documents">
            <!-- Each Document Card -->
            <!-- ID Card -->
            @for ($j = 0; $j < 9; $j++)
                <div class="col-12 col-sm-6 col-lg-4">
                    <label class="card p-4 text-center document-card">
                        <input type="checkbox" class="doc-checkbox" value="id_card" />
                        <div>
                            <svg width="32" height="32" fill="#43aa8b" viewBox="0 0 16 16">
                                <path d="M0 4a2 2 0 012-2h12a2 2 0 012 2v1H0V4z" />
                                <path
                                    d="M0 6h16v6a2 2 0 01-2 2H2a2 2 0 01-2-2V6zm4 1a1 1 0 100 2 1 1 0 000-2zm0 3.5a2.5 2.5 0 00-2.5 2H6.5a2.5 2.5 0 00-2.5-2zm3-.5h5v1H7V10zm0-2h5v1H7V8z" />
                            </svg>
                        </div>
                        <h6 class="mt-3">ID Card</h6>
                    </label>
                </div>
            @endfor
        </div>
    </div>
    @include('front.includes.index_footer')

    @include('front.includes.index_download_button')

    @include('front.includes.index_footer_script')
</body>

</html>
