<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Property</title>

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
                <h4 class="text-xl font-semibold">Update Property</h4>
            </div>

            <!-- Body -->
            <div class="p-6">

                @if(session('error'))
                    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST"
                      action="{{ url('/property/' . $property->id) }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Title -->
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1">Title</label>
                        <input type="text" name="title"
                               value="{{ $property->title }}"
                               class="w-full border p-2 rounded focus:ring-2 focus:ring-blue-400"
                               required>
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1">Description</label>
                        <textarea name="description" rows="4"
                                  class="w-full border p-2 rounded focus:ring-2 focus:ring-blue-400"
                                  required>{{ $property->description }}</textarea>
                    </div>

                    <!-- Type -->
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1">Type</label>
                        <input type="text" name="type"
                               value="{{ $property->type }}"
                               class="w-full border p-2 rounded focus:ring-2 focus:ring-blue-400"
                               required>
                    </div>

                    <!-- Price -->
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1">Price</label>
                        <input type="number" name="price"
                               value="{{ $property->price }}"
                               class="w-full border p-2 rounded focus:ring-2 focus:ring-blue-400"
                               required>
                    </div>

                    <!-- Location -->
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1">Location</label>
                        <input type="text" name="location"
                               value="{{ $property->location }}"
                               class="w-full border p-2 rounded focus:ring-2 focus:ring-blue-400"
                               required>
                    </div>

                    <!-- Status -->
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1">Status</label>
                        <select name="status"
                                class="w-full border p-2 rounded focus:ring-2 focus:ring-blue-400"
                                required>
                            <option value="available"
                                {{ $property->status == 'available' ? 'selected' : '' }}>
                                Available
                            </option>

                            <option value="sold"
                                {{ $property->status == 'sold' ? 'selected' : '' }}>
                                Sold
                            </option>
                        </select>
                    </div>

                    <!-- Image -->
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1">Image</label>

                        <input type="file" name="image"
                               class="w-full border p-2 rounded">

                        @if($property->image)
                            <img src="{{ asset('storage/' . $property->image) }}"
                                 class="mt-2 rounded border"
                                 width="150">
                        @endif
                    </div>

                    <!-- Button -->
                    <button type="submit"
                            class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
                        Update Property
                    </button>

                </form>

            </div>
        </div>

    </div>
</div>

</body>
</html>
