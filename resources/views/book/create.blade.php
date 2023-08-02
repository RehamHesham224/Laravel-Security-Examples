<x-layout>
    <div class="container mt-5">
        <h2>Create Book</h2>
        <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" >
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="Image" class="form-label">Image</label>
                <input type="file" name="image" id="image">
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
</x-layout>
