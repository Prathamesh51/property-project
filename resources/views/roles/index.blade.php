<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roles</title>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gray-100">

    <!-- Header -->
    @include('property.header')

    <!-- Main Container -->
    <div class="container mx-auto mt-6 bg-white p-5 rounded shadow">

        <!-- Create Button (Only Admin) -->
        @admin
        <div class="mb-4">
            <a href="{{ url('/roles/create') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Create Role
            </a>
        </div>
        @endadmin
        <!-- Table -->
        <div id="roles-list">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border p-2 text-left">Roles</th>

                        @admin
                        <th class="border p-2 text-left">Action</th>
                        @endadmin
                    </tr>
                </thead>

                <tbody>
                    @foreach ($roles as $role)
                    <tr class="hover:bg-gray-50">
                        <td class="border p-2">
                            {{ $role->name }}
                        </td>
                        @admin
                        <td class="border p-2">

                            <!-- Edit Button -->
                            <a href="{{ url('/roles/' . $role->id . '/edit') }}"
                                class="bg-gray-600 text-white px-3 py-1 rounded hover:bg-gray-700 text-sm">
                                Edit
                            </a>

                        </td>
                        @endadmin
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>