@include('front.login_includes.login_header')

<body class="bg-[#FFF8F0] flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md bg-white shadow-lg rounded-2xl p-8 space-y-6">

        @include('front.login_includes.login_welcome_back')

        @include('front.login_includes.login_messages')

        <!-- Login Form -->
        <form action="{{ url('user-login') }}" method="POST" class="space-y-5" autocomplete="off">
            @csrf
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" name="username" id="username" required autocomplete="off"
                    class="mt-1 w-full px-4 py-2 border border-[#D1D5DB] rounded-md bg-white text-[#2F2F2F] focus:outline-none focus:ring-2 focus:ring-[#90BE6D]">
            </div>


            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" required autocomplete="new-password"
                    class="mt-1 w-full px-4 py-2 border border-[#D1D5DB] rounded-md bg-white text-[#2F2F2F] focus:outline-none focus:ring-2 focus:ring-[#90BE6D]">
            </div>

            <button type="submit"
                class="w-full py-2 px-4 bg-[#43AA8B] text-white font-semibold rounded-md hover:bg-[#379a7a] transition">
                Login
            </button>
        </form>
    </div>
</body>

</html>
