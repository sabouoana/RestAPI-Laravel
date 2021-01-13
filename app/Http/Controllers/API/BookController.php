<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Book;
use Validator;

class BookController extends Controller
{
    public function index(){
        $books = Book::all();
        $data = $books->toArray();

        $response = [

            'success' => true,
            'data' => $data,
            'message' => 'Books retrieved successfully'
        ];
        
        return response() -> json($response,200);
    }

    public function store(Request $request){
        $input = $response -> all();
        $validator=Validator::make($input, [
            'name'->'required',
            'author'->'required'
        ]);

        if($validator -> fails()){
            $response = [
                'success' => false,
                'data' => "Validation Error.",
                'message' => $validator ->errors()
            ];

            return response()->json($response,404);
        }

        $book = Book::create($input);
        $data = $book ->toArray();
        $response = [
            'success'=>true,
            'data'=> $data,
            'message'=>'Book stored successfully'
        ];

        return response()->json($response,200);
    }

    public function show($id){
        $book = Book::find($id);
        $data = $book->toArray();

        if(is_null($book)){
            $response=[
                'success' => false,
                'data'=>'Empty',
                'message'=>'Book not found.'
            ];
            return response()->json($response,404);
        
        }

        $response = [
            'success'=>true,
            'data'=>$data,
            'message'=>'Book retrieved successfully.'
        ];

        return response()->json($response,200);
    }


    public function update(Request $request, Book $book){
        $input = $request->all();
        $validator = Validator::make($input, [
'name'=> 'required',
'author' =>'required'
        ]);

        if($validator->fails()){
            $response=[
            'success'=>false,
            'data'=>'Validation Error.',
            'message'=>$validator->errors()];
            return respnse()->json($response,404);
        }
        $book -> name = $input['name'];
        $book->author=$input['author'];
        $book->save();

        $response = [
            'success' => true,
            'data'=>$data,
            'message'=>'Book update successfully.'
        ];

        return response()->json($response,200);
    }

    public function destroy(Book $book){
        $book->delete();
        $data = $book->toArray();

        $response=[
            'success' => true,
            'data'=>$data,
            'message'=>'Book deleted successfully.'
        ];
        return response()->json($response,200);
    }
}
