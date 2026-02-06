<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md">

        <div class="bg-white shadow-lg rounded-lg">

            <!-- Header -->
            <div class="bg-gray-900 text-white text-center py-4 rounded-t-lg">
                <h4 class="text-xl font-semibold">Admin Login</h4>
            </div>

            <!-- Body -->
            <div class="p-6">

                @if(session('error'))
                    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ url('/login/admin') }}">
                    @csrf

                    <!-- Email -->
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1">Email</label>

                        <input
                            type="email"
                            name="email"
                            class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-gray-500"
                            required
                        >
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1">Password</label>

                        <input
                            type="password"
                            name="password"
                            class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-gray-500"
                            required
                        >
                    </div>

                    <!-- Button -->
                    <button class="w-full bg-gray-900 text-white py-2 rounded hover:bg-gray-800 transition">
                        Login
                    </button>

                </form>

            </div>
        </div>

    </div>
</div>

</body>
</html>