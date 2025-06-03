@if (session('success'))
    <div id="popupAlert" class="alert alert-success alert-dismissible fade show popupAlert-success" role="alert">
        <strong>Success!</strong> {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div id="popupAlert" class="alert alert-danger alert-dismissible fade show popupAlert-danger" role="alert">
        <strong>Error!</strong> {{ session('error') }}
    </div>
@endif
