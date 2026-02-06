<table class="w-full border-collapse">
    <thead>
        <tr class="bg-gray-200">
            <th class="border p-2 text-left">Properties</th>
            <th class="border p-2 text-left">Price</th>

            @admin
            <th class="border p-2 text-left">Action</th>
            @endadmin
        </tr>
    </thead>

    <tbody>
        @foreach ($properties as $property)
        <tr class="hover:bg-gray-50">
            <td class="border p-2">
                {{ $property->title }}
            </td>

            <td class="border p-2">
                {{ $property->price }}
            </td>

            @admin
            <td class="border p-2">

                <!-- Edit Button -->
                <a href="{{ url('/property/' . $property->id . '/edit') }}"
                    class="bg-gray-600 text-white px-3 py-1 rounded hover:bg-gray-700 text-sm">
                    Edit
                </a>

                <!-- Delete Form -->
                <form action="{{ url('/property/' . $property->id) }}"
                    method="POST"
                    class="inline">
                    @csrf
                    @method('DELETE')

                    <button type="submit"
                        class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 text-sm"
                        onclick="return confirm('Are you sure you want to delete this property?')">
                        Delete
                    </button>
                </form>

            </td>
            @endadmin
        </tr>
        @endforeach
    </tbody>
</table>