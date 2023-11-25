<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class CommentController extends Controller
{
    //CRUD Companies returns JSON
    //Все записи
    public function index(){
        //Из-за того, что присутствует мягкое удаление у связанных таблиц, нельзя выводить комментарии пользователей и компаний, которые удалены
        $comments= DB::table('comments')
            ->join('users', 'comments.user_id', '=', 'users.id')
            ->join('companies', 'comments.company_id', '=', 'companies.id')
            ->select('comments.*',)
            ->where('users.deleted_at',null)
            ->where('companies.deleted_at',null)
            ->where('comments.deleted_at',null)
            ->get();
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
        //Проверка на мягкое удаление ключей
        if(User::find($data->user_id) == null || Company::find($data->company_id)==null){
            return response ('Comment not found', 404);
        }
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
        //Проверка на мягкое удаление ключей
        if(User::find($comment->user_id) == null || Company::find($comment->company_id)==null){
            return response ('Comment not found', 404);
        }
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
        //Проверка на мягкое удаление ключей
        if(User::find($data->user_id) == null || Company::find($data->company_id)==null){
            return response ('Comment not found', 404);
        }
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
        //Проверка на мягкое удаление ключей
        if(User::find($comment->user_id) == null || Company::find($comment->company_id)==null){
            return response ('Comment not found', 404);
        }
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
        //Проверка на мягкое удаление ключей
        if(User::find($comment->user_id) == null || Company::find($comment->company_id)==null){
            return response ('Comment not found', 404);
        }
        return view('comments.edit', compact('comment'));
    }
    public function delete(Comment $comment){
        //Проверка на мягкое удаление ключей
        if(User::find($comment->user_id) == null || Company::find($comment->company_id)==null){
            return response ('Comment not found', 404);
        }
        return view('comments.delete', compact('comment'));
    }
}
