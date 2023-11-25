<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Services\StatisticsService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    //CRUD Companies returns JSON
    //Все записи
    public function index(){
        $companies= Company::all();
        return response()->json($companies);
    }

    //Добавление записи в таблицу
    public function store(){
        $data = request()->validate([
            'title'=>['string','required','min:3', 'max:40'],
            'description'=>['string','required','min:150', 'max:400'],
            'logo'=>['required','mimes:image:png','max:3072']
        ]);
        //Обработка изображения
        if(\request()->hasFile('logo')){
            $image = \request()->file('logo');
            $path = $image->store('logos');
            $data['logo']=$path;
        }
        $company = Company::create($data);
        return response()->json($company);
    }

    //Отображение одной записи
    public function show(Company $company){
        return response()->json($company);
    }

    //Изменение записи в таблице
    public function update(Company $company){
        $data = request()->validate([
            'title'=>['string','required','min:3', 'max:40'],
            'description'=>['string','required','min:150', 'max:400'],
            'logo'=>['sometimes','mimes:image:png','max:3072']
        ]);
        //Обработка изображения
        if(request()->hasFile('logo')){
            Storage::delete($company->logo);
            $image = \request()->file('logo');
            $path = $image->store('logos');
            $data['logo']=$path;
        }
        $company->update($data);
        return response()->json($company);
    }

    //Удаление записи из таблицы
    public function destroy(Company $company){
        try {
            $company->delete();
        } catch(\Illuminate\Database\QueryException $ex){
            return response($ex->getMessage(),400);
        }
        Storage::delete($company->logo);
        return response('',200);
    }

    //UI Companies (Forms)
    public function create(){
        return view('companies.create');
    }
    public function edit(Company $company){
        return view('companies.edit', compact('company'));
    }
    public function delete(Company $company){
        return view('companies.delete', compact('company'));
    }

    //Services
    //Комментарии по id компании
    public function commentsByID($id, StatisticsService $service){
        try{
            return response()->json($service->start($id,'getCommentsByID'));
        }
        catch(Exception $ex){
                return response($ex->getMessage(),404);
        }
    }
    //Общая оценка компании
    public function companyRate($id, StatisticsService $service){
        try{
            return response()->json($service->start($id,'getRateByID'));
        }
        catch(Exception $ex){
            return response($ex->getMessage(),404);
        }
    }
    //Рейтинг компаний
    public function companiesRating(StatisticsService $service){
        try{
            return response()->json($service->start(null,'getCompaniesByRate'));
        }
        catch(Exception $ex){
            return response($ex->getMessage(),404);
        }
    }
}
