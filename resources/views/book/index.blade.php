<x-layout>
    <div>
        <form action="{{route('books.index')}}" method="GET" class="w-50 m-auto flex justify-center mb-5 ">
            {{--            Good Way         --}}
            <input
                type="search"
                name="search"
                class="form-input mt-1 block w-full p-4 "
                value="{{request('search')}}"
            >
{{--            Bad Way         --}}
{{--            <input--}}
{{--                type="search"--}}
{{--                name="search"--}}
{{--                class="form-input mt-1 block w-full p-4 "--}}
{{--                value="{!! request('search') !!}"--}}
{{--            >--}}
            <button type="submit" class="btn btn-info p-4 ">Search</button>
        </form>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
            @foreach($books as $book)
                <div class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none  motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                    <div class="d-block m-3 ">Title: {{$book->title}}</div>
                    <div class="d-block m-3 ">Slug: {{$book->slug}}</div>
                    <div class="d-block m-3 ">Description: {{$book->description}}</div>
                    @if ($book->image)
                        <img src="{{ asset('storage/' . $book->image) }}" alt="Book Image">
                    @else
                        <p>No Image Available</p>
                    @endif
                    <div class="d-block m-3 ">
                        <form method="post" action="{{route('books.destroy',$book->id)}}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                    <div class="d-block m-3 ">
                       <a href="{{route('books.edit',$book->id)}}" class="btn btn-info">Edit</a>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Let all your things have their places; let each part of your business have its time. - Benjamin Franklin -->
    </div>

</x-layout>
