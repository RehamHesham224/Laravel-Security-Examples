<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
//        $this->authorizeResource('book');
    }

    public function index(Request $request)
    {
        $search = $request->get('search');
        $books = Book::query()
            ->select('image','description','title','slug','user_id')
            ->with('user:id,name')
            ->search($search)
            ->oldest()
            ->get();

        return view('book.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('book.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif', // Assuming the maximum image size is 2MB (2048 KB)
        ]);

        // Set the user_id from the authenticated user
        $data['user_id'] = auth()->id();

        // Handle image upload if a file is provided
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('books', 'public');
            $data['image'] = $imagePath;
        }


        //don't do this , it gives you all fallible properties
//        $body=Book::create($request->all());

        //this is a correct way to get exact properties in validation method
        $book = Book::create($data);

        return redirect()->route('books.show', ['book' => $book->slug]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        $this->authorize('view',$book);
//        dd($book );
        return view('book.show',compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $this->authorize('update',$book);

        return view('book.edit',compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        //
        $data=$request->validate([
            'title'=>'required',
            'description'=>'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Assuming the maximum image size is 2MB (2048 KB)
            'current_image' => 'nullable', // Required to keep the existing image filename
        ]);
        $data['user_id'] = auth()->id();
        // Handle image upload if a new file is provided
        if ($request->hasFile('image')) {
            // Delete the existing image (optional, depending on your requirements)
            Storage::delete('public/books/' . $data['current_image']);

            // Upload the new image and update the image filename in $data array
            $imagePath = $request->file('image')->store('books', 'public');
            $data['image'] = $imagePath;
        } else {
            // Use the existing image filename from the hidden input
            $data['image'] = $data['current_image'];
        }
        $book->update($data);
        return back()->with(['message' =>'Book Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return back()->with(['message' =>'Book Destroyed Successfully']);
    }
}
