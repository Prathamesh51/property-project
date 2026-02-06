<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gray-100">

    <!-- Header -->
    @include('property.header')

    <!-- Main Container -->
    <div class="container mx-auto mt-6 bg-white p-5 rounded shadow">
        <!-- Table -->
        <div id="usersData">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border p-2 text-left">Name</th>
                        <th class="border p-2 text-left">Email</th>
                        <th class="border p-2 text-left">Status</th>
                        <th class="border p-2 text-left">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($users as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="border p-2">
                            {{ $user->name }}
                        </td>

                        <td class="border p-2">
                            {{ $user->email }}
                        </td>

                        <td class="border p-2">
                            {{ $user->is_active ? 'Active' : 'Inactive' }}
                        </td>
                        <td class="border p-2">
                            @if (!$user->is_active)
                            <form action="{{ url('property/approve-request/' . $user->id) }}"
                                method="POST"
                                class="inline">
                                @csrf
                                <button type="submit"
                                    class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700 text-sm">
                                    Approve
                                </button>
                            </form>
                            @else
                            <span class="text-gray-600 text-sm">Approved</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>