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

        <!-- Create Button (Only Admin) -->
        @admin
        <div class="mb-4">
            <a href="{{ url('/property/create') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Create Property
            </a>
        </div>
        @endadmin

        <!-- Search & Filter -->
        <div class="mb-4 p-4 bg-gray-50 rounded">

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                <input type="text" id="search"
                    placeholder="Search title, price, location..."
                    class="border p-2 rounded w-full">

                <input type="number" id="min_price"
                    placeholder="Min Price"
                    class="border p-2 rounded w-full">

                <input type="number" id="max_price"
                    placeholder="Max Price"
                    class="border p-2 rounded w-full">

                <button onclick="filterData()"
                    class="bg-blue-600 text-white px-4 py-2 rounded">
                    Filter
                </button>

            </div>
        </div>
        <!-- Table -->
        <div id="propertyData">
            @include('property.propertyTable', ['properties' => $properties])
        </div>

        <div class="mt-4">
            {{ $properties->links() }}
        </div>
    </div>

</body>
<script src="https://code.jquery.com/jquery-4.0.0.js"></script>
<script>

    $(document).on('click','.pagination a', function(e){
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        filterData(page)
    })

    function filterData(page = 1) {
        let search = $('#search').val();
        let min_price = $('#min_price').val();
        let max_price = $('#max_price').val();

        $.ajax({
            'url': '{{ url("/property/filter") }}?page=' + page,
            'type': 'GET',
            'data': {
                'search': search,
                'min_price': min_price,
                'max_price': max_price
            },
            success: function(response) {
                console.log(response);
                $('#propertyData').html(response);
            },
            error: function(xhr) {
                console.log("===== ERROR =====");
                console.log(xhr.responseText);
                alert("Something went wrong in AJAX");
            }
        });

    }
</script>

</html>