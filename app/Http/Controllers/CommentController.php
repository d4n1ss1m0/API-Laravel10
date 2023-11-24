<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class CommentController extends Controller
{
    //CRUD Companies returns JSON
    //Все записи
    public function index(){
        $comments= Comment::all();
        return response()->json($comments);
    }
    //Добавление записи в таблицу
    public function store(){
        $data = request()->validate([
            'user_id'=>['integer','required','min:1'],
            'company_id'=>['integer','required','min:1'],
            'content'=>['required','string','min:150', 'max:550'],
            'score'=>['required','integer','min:1', 'max:10']
        ]);
        //проверка на ошибку внешних ключей
        try {
            $comment = Comment::create($data);
        } catch(\Illuminate\Database\QueryException $ex){
            return response($ex->getMessage(),400);
        }
        return response()->json($comment);
    }

    //Отображение одной записи
    public function show(Comment $comment){
        return response()->json($comment);
    }
    //Изменение записи в таблице
    public function update(Comment $comment){
        $data = request()->validate([
            'user_id'=>['integer','required','min:1'],
            'company_id'=>['integer','required','min:1'],
            'content'=>['required','string','min:150', 'max:550'],
            'score'=>['required','integer','min:1', 'max:10']
        ]);
        //проверка на внешние ключи
        try {
            $comment->update($data);
        } catch(\Illuminate\Database\QueryException $ex){
            return response($ex->getMessage(),400);
        }
        return response()->json($comment);
    }
    //Удаление записи
    public function destroy(Comment $comment){
        try{
            $comment->delete();
        } catch(\Illuminate\Database\QueryException $ex){
            return response($ex->getMessage(),400);
        }
        return response('',200);
    }

    //UI Comments (forms)
    public function create(){
        return view('comments.create');
    }
    public function edit(Comment $comment){
        return view('comments.edit', compact('comment'));
    }
    public function delete(Comment $comment){
        return view('comments.delete', compact('comment'));
    }
}
