<div class="bg-white shadow p-4 flex justify-between items-center">
        <h5 class="text-lg font-semibold">
            Login User : {{ $userName }}
        </h5>
        
        <a href="{{ url('/property') }}"
            class="text-red-600 hover:text-red-800 text-sm font-semibold">
            View Properties
        </a>
        <a href="{{ url('/property/user-requests') }}"
            class="text-blue-600 hover:text-blue-800 text-sm font-semibold">
            User Requests
        </a>
        <a href="{{ url('/logout') }}"
            class="text-red-600 hover:underline text-sm">
            Logout
        </a>
    </div>