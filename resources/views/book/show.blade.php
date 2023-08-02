<x-layout>
    <div class="container mx-auto mt-8 p-8 max-w-md bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold mb-4">Book Details</h2>
        <div class="mb-4">
            {{ $book->title }}
        </div>
        <div class="mb-4">
            {{ $book->description }}
        </div>
        <a href="{{ route('books.edit', $book->slug) }}" class="btn btn-primary bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded">Edit</a>
    </div>

</x-layout>
