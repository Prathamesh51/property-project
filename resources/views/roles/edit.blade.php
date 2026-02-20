<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Role</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gray-100">
 <!-- Header -->
    @include('property.header')

<div class="min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-lg">

        <!-- Card -->
        <div class="bg-white shadow-lg rounded-lg">

            <!-- Header -->
            <div class="bg-blue-600 text-white text-center py-4 rounded-t-lg">
                <h4 class="text-xl font-semibold">Update Role</h4>
            </div>

            <!-- Body -->
            <div class="p-6">

                @if(session('error'))
                    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST"
                      action="{{ url('/roles/' . $role->id) }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Title -->
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1">Name</label>
                        <input type="text" name="name"
                               value="{{ $role->name }}"
                               class="w-full border p-2 rounded focus:ring-2 focus:ring-blue-400"
                               required>
                    </div>

                    <!-- permisions -->
                    <div class="mb-4">
                      <input type="checkbox" id="select_all" class="mb-2">
                      <label for="select_all">Select All Permissions</label>
                       <div class="grid grid-cols-2 gap-2 mt-2">
                        @foreach($permissions as $group => $groupPermissions)

                            <div class="flex items-center justify-between mb-2">
                                <strong> {{ $group }}</strong>
                                <input type="checkbox" class="select-group" data-group="{{ Str::slug($group) }}">
                            </div>
                            <div>
                                @foreach($groupPermissions as $permission)
                                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="perm_{{ $permission->id }}"
                                           {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }} class="permission-checkbox">
                                    <label for="perm_{{ $permission->id }}">{{ $permission->name }}</label><br>
                                @endforeach
                            </div>
                        @endforeach
                       </div>

                    </div>

                    <!-- Button -->
                    <button type="submit"
                            class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
                        Update Role
                    </button>
                </form>

            </div>
        </div>

    </div>
</div>

</body>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectAllCheckbox = document.getElementById('select_all');
        const permissionCheckboxes = document.querySelectorAll('.permission-checkbox');

        selectAllCheckbox.addEventListener('change', function() {
            permissionCheckboxes.forEach( function (checkbox){
                checkbox.checked = selectAllCheckbox.checked;
            });
        });

        const groupCheckboxes = document.querySelectorAll('.select-group');
        groupCheckboxes.forEach(function(groupCheckbox) {
            groupCheckbox.addEventListener('change', function() {
                const group = groupCheckbox.getAttribute('data-group');
                const groupPermissions = document.querySelectorAll('.permission-checkbox[data-group="' + group + '"]');
                groupPermissions.forEach(function(permissionCheckbox) {
                    permissionCheckbox.checked = groupCheckbox.checked;
                }); 
            })
        })
    });
</script>
</html>
