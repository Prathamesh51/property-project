<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gray-100">

    <!-- Header -->
    @include('property.header')

    <!-- Main Container -->
    <div class="container mx-auto mt-6 bg-white p-5 rounded shadow">
        @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif
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
                            <form action="{{ url('roles/assign/' . $user->id) }}"
                                method="POST"
                                class="inline">
                                @csrf
                                <label for="role-select-{{ $user->id }}" class="text-sm">Assign Role:</label>
                                <select name="role_id" id="role-select-{{ $user->id }}" class="ml-2 text-sm border rounded p-1">
                                    <option value="#">Select Role</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}"  {{ $user->roles->contains($role->id) ? 'selected' : '' }}>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="ml-2 bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700 text-sm">
                                    Assign
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>