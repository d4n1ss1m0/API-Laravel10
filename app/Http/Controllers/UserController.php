<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    //CRUD Users returns JSON
    //Все строки
    public function index(){
        $users= User::all();
        return response()->json($users);
    }

    //Запись в таблицу
    public function store(){
        $data = request()->validate([
            'name'=>['string','required','min:3', 'max:40'],
            'surname'=>['string','required','min:3', 'max:40'],
            'phone'=>['string','required','regex:/^\+7\d{10}$/','min:12', 'max:12'],
            'avatar'=>['required','mimes:image:jpg,jpeg,png','max:2048']
        ]);
        //Обработка изображения
        if(\request()->hasFile('avatar')){
            $image = \request()->file('avatar');
            $path = $image->store('avatars');
            $data['avatar']=$path;
        }
        $user = User::create($data);
        return response()->json($user);
    }

    //Отображение одной строки
    public function show(User $user){
        return response()->json($user);
    }

    //Обновление данных в таблице
    public function update(User $user){
        $data = request()->validate([
            'name'=>['string','required','min:3', 'max:40'],
            'surname'=>['string','required','min:3', 'max:40'],
            'phone'=>['string','required','regex:/^\+7\d{10}$/','min:12', 'max:12'],
            'avatar'=>['required','mimes:image:jpg,jpeg,png','max:2048']
        ]);
        //Обработка изображения
        if(request()->hasFile('avatar')){
            Storage::delete($user->avatar);
            $image = \request()->file('avatar');
            $path = $image->store('avatars');
            $data['avatar']=$path;
        }
        $user->update($data);
        return response()->json($user);
    }

    //Удаление данных из таблицы
    public function destroy(User $user){
        Storage::delete($user->avatar);
        try{
            $user->delete();
        } catch(\Illuminate\Database\QueryException $ex){
            return response($ex->getMessage(),400);
        }
        return response('',200);
    }

    //UI Users (forms)
    public function create(){
        return view('users.create');
    }
    public function edit(User $user){
        return view('users.edit', compact('user'));
    }
    public function delete(User $user){
        return view('users.delete', compact('user'));
    }
}
