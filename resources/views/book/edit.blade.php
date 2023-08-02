<x-layout>
    <div class="container mx-auto mt-8 p-8 max-w-md bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold mb-4">Edit Book</h2>
        <form action="{{ route('books.update', $book->slug) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="title" class="block font-medium text-gray-700">Title</label>
                <input type="text" class="form-input mt-1 px-4 py-3 w-full bg-gray-100" id="title" name="title" value="{{ $book->title }}" required>
            </div>
            <div class="mb-4">
                <label for="description" class="d-block font-medium text-gray-700">Description</label>
                <textarea class="form-textarea mt-1 px-4 py-3 w-full bg-gray-100" id="description" name="description" rows="3" required>{{ $book->description }}</textarea>
            </div>
            <div class="mb-3">
                <input type="hidden" name="current_image" value="{{ $book->image }}">
                @if ($book->image)
                    <img src="{{ asset('storage/' . $book->image) }}" alt="Book Image">
                @else
                    <p>No Image Available</p>
                @endif
                <label for="Image" class="form-label">Image</label>
                <input type="file" name="image" id="image">
            </div>
            <button type="submit" class="btn btn-primary bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded">Update</button>
        </form>
    </div>
</x-layout>
