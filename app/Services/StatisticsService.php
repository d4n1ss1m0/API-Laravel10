<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\Company;
use Composer\Autoload\ClassLoader;
use Exception;
use Illuminate\Support\Facades\DB;

class StatisticsService
{
    public function start($data, $method = 'getCommentsByID'){
        //Существует ли метод
        if (!method_exists($this, $method)) {
            throw new Exception("Method not found", 404);}
        //У метода рейтинга нет входного парраметра, поэтому его следует отделить от остальных
        if ($method == 'getCompaniesByRate' && $data=='') {
            return $this->$method();
        }
        else{
            //Проверка, что переданные данные - число (id)
            if(is_numeric($data)) {
                return $this->$method($data);
            }
            else{
                throw new Exception("ID must be digit", 400);
            }
        }
    }

    protected function getCommentsByID (int $id){
        //Если компании нет
        if(is_null(Company::find($id))){
            throw new Exception("Company not found", 404);
        }
        return Comment::where('company_id',$id)->get();
    }

    protected function getRateByID (int $id){
        //Получение рейтинга компании
        $rate= DB::table('comments',)->where('company_id',$id)->avg('score');
        $company = Company::find($id);
        //Если компании нет
        if(is_null($company)){
            throw new Exception("Company not found", 404);
        }
        //Добавление рейтинга к ответу
        $company['rate'] = $rate;
        return $company;
    }

    //Получение рейтинга компаний
    protected function getCompaniesByRate (){
        $rating = DB::table('comments')->select(DB::raw('company_id as company, AVG(score) as rate'))->groupBy('company_id')->limit(10)->orderByDesc('rate')->get();
        //Добавление к информации о компаниях ответу
        foreach ($rating as $item) {
            $item->company = Company::find($item->company);
        }
        return $rating;
    }
}
