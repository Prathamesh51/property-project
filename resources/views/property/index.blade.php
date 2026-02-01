<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="card-footer text-center">
        <small><a href="{{ url('/logout') }}">Logout</a></small>
    </div>
    <h5> Login User : {{ $userName }}</h5>
    <div class="container mt-5 bg-light">
        @admin
            <a href="{{ url('/property/create') }}" class="btn btn-primary">
                Create
            </a>
        @endadmin
        <table>
            <tr>
                <th>Properties</th>
                @admin
                <th>action</th>
                @endadmin
            </tr>
            <tr>
                @foreach ($properties as $property)
            <tr>
                <td>
                    {{ $property->title }}
                </td>
                <td>
                    @admin
                    <a href="{{ url('/property/' . $property->id . '/edit') }}" class="btn btn-secondary">
                        Edit
                    </a>
                    <form action="{{ url('/property/' . $property->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Are you sure you want to delete this property?')">
                            Delete
                        </button>
                    </form>

                    @endadmin
                </td>
            </tr>
            @endforeach
            </tr>
        </table>
    </div>
</body>

</html>