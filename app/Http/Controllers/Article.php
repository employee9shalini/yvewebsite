<?php

namespace App\Http\Controllers;
use DB;
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Database\Eloquent\Model;
use Input;
use Request;
use app\model\loaddata;
//use app/config/database.php;
class Article extends Controller
{

	public function articlePage(){



		
		  $article = DB::table('article')->select('article_id','headline', 'image_type', 'article_image_hd', 'article_image_normal', 'article_thumb_hd', 'article_thumb_normal', 'article_source_name', 'article_source_link','send_notification','publish_flag', 'publish_datetime', 'article_author', 'article_added_by', 'tags', 'create_datetime')->get();


	}

	
}