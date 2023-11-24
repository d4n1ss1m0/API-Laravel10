<?php

use App\Models\Comment;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //Тестовые данные
        $usersData = [
            [
                'name' => 'user1',
                'surname' => 'surname1',
                'phone'=>'+79999999999',
                'avatar'=>'avatars/avatar1'
            ],
            [
                'name' => 'user2',
                'surname' => 'surname2',
                'phone'=>'+78888888888',
                'avatar'=>'avatars/avatar2'
            ],
            [
                'name' => 'user3',
                'surname' => 'surname3',
                'phone'=>'+77777777777',
                'avatar'=>'avatars/avatar3'
            ]
        ];
        $companiesData = [
            [
                'title' => 'company1',
                'description' => 'description1aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaаааааааааааааааааааааааааааааааааааааааааааа',
                'logo'=>'logos/logo1'
            ],
            [
                'title' => 'company2',
                'description' => 'description2aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaаааааааааааааааааааааааааааааааааааааааааааа',
                'logo'=>'logos/logo2'
            ],[
                'title' => 'company3',
                'description' => 'description3aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaаааааааааааааааааааааааааааааааааааааааааааа',
                'logo'=>'logos/logo3'
            ],[
                'title' => 'company4',
                'description' => 'description4aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaаааааааааааааааааааааааааааааааааааааааааааа',
                'logo'=>'logos/logo4'
            ],[
                'title' => 'company5',
                'description' => 'description5aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaаааааааааааааааааааааааааааааааааааааааааааа',
                'logo'=>'logos/logo5'
            ],[
                'title' => 'company6',
                'description' => 'description6aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaаааааааааааааааааааааааааааааааааааааааааааа',
                'logo'=>'logos/logo6'
            ],[
                'title' => 'company7',
                'description' => 'description7aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaаааааааааааааааааааааааааааааааааааааааааааа',
                'logo'=>'logos/logo7'
            ],[
                'title' => 'company8',
                'description' => 'description8aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaаааааааааааааааааааааааааааааааааааааааааааа',
                'logo'=>'logos/logo8'
            ],[
                'title' => 'company9',
                'description' => 'description9aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaаааааааааааааааааааааааааааааааааааааааааааа',
                'logo'=>'logos/logo9'
            ],[
                'title' => 'company10',
                'description' => 'description10aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaаааааааааааааааааааааааааааааааааааааааааааа',
                'logo'=>'logos/logo10'
            ],[
                'title' => 'company11',
                'description' => 'description1aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaаааааааааааааааааааааааааааааааааааааааааааа',
                'logo'=>'logos/logo11'
            ]

        ];
        $commentsData = [
            [
                'user_id' => '1',
                'company_id' => '1',
                'content' => 'content1aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaааааааааааааааааааааааааааааааааааааааааааааааа',
                'score'=>'10'
            ],
            [
                'user_id' => '2',
                'company_id' => '1',
                'content' => 'content2aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaааааааааааааааааааааааааааааааааааааааааааааааа',
                'score'=>'7'
            ],[
                'user_id' => '3',
                'company_id' => '1',
                'content' => 'content3aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaааааааааааааааааааааааааааааааааааааааааааааааа',
                'score'=>'7'
            ],[
                'user_id' => '1',
                'company_id' => '2',
                'content' => 'content4aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaааааааааааааааааааааааааааааааааааааааааааааааа',
                'score'=>'10'
            ],[
                'user_id' => '1',
                'company_id' => '3',
                'content' => 'content5aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaааааааааааааааааааааааааааааааааааааааааааааааа',
                'score'=>'9'
            ],[
                'user_id' => '1',
                'company_id' => '4',
                'content' => 'content6aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaааааааааааааааааааааааааааааааааааааааааааааааа',
                'score'=>'8'
            ],[
                'user_id' => '1',
                'company_id' => '5',
                'content' => 'content7aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaааааааааааааааааааааааааааааааааааааааааааааааа',
                'score'=>'7'
            ],[
                'user_id' => '1',
                'company_id' => '6',
                'content' => 'content8aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaааааааааааааааааааааааааааааааааааааааааааааааа',
                'score'=>'6'
            ],[
                'user_id' => '1',
                'company_id' => '7',
                'content' => 'content9aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaааааааааааааааааааааааааааааааааааааааааааааааа',
                'score'=>'5'
            ],[
                'user_id' => '1',
                'company_id' => '8',
                'content' => 'content10aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaааааааааааааааааааааааааааааааааааааааааааааааа',
                'score'=>'4'
            ],[
                'user_id' => '1',
                'company_id' => '9',
                'content' => 'content11aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaааааааааааааааааааааааааааааааааааааааааааааааа',
                'score'=>'3'
            ],[
                'user_id' => '1',
                'company_id' => '10',
                'content' => 'content12aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaааааааааааааааааааааааааааааааааааааааааааааааа',
                'score'=>'2'
            ]
        ];
        foreach ($usersData as $item){
            User::create($item);
        }
        foreach ($companiesData as $item){
            Company::create($item);
        }
        foreach ($commentsData as $item){
            Comment::create($item);
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        User::truncate();
        Company::truncate();
        Comment::truncate();
    }
};
