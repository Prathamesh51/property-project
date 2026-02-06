<div class="bg-white shadow p-4 flex justify-between items-center">
        <h5 class="text-lg font-semibold">
            Login User : {{ $userName }}
        </h5>

        <a href="{{ url('/logout') }}"
            class="text-red-600 hover:underline text-sm">
            Logout
        </a>
    </div>