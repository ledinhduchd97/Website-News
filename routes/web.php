<?php
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Hash;
// use App\User;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Trang chủ
Route::group(['prefix' => '','middleware' => ['CheckAdmin_Ctv']], function() {
    Route::get('/','HomeController@index')->name('index');
	Route::get('/search','HomeController@search' )->name('search.index');
	Route::post('/livesearch','HomeController@liveSearch' )->name('livesearch.index');
	Route::get('/gettitle','HomeController@get_Title_Slide')->name('get.title.slide');
	// ------------------------------------------------------------------------------------------
	// Trang tin tức
	Route::get('/pagetintuc/{id}','PageTinTucController@index')->name('index.pagetintuc');
	Route::get('/pagetintuc/search/{id}','PageTinTucController@search')->name('search.pagetintuc');
	// ------------------------------------------------------------------------------------------
	// Trang chi tiết
	Route::group(['prefix' => '/pagechitiet'], function() {
		Route::get('/{id}/{tieude}','PageChitietController@index')->name('index.pagechitiet');
		Route::post('/comment/{id}','PageChitietController@comment')->name('comment.pagechitiet');
		Route::get('/delete/comment/{id}','PageChitietController@delete_comment')->name('del.comment.pagechitiet');
	});
});
Route::get('/sign-up','HomeController@getSign_up')->name('get.sign_up');
Route::post('/sign-up','HomeController@postSign_up')->name('post.sign_up');
Route::post('/sign-up/checkemail','HomeController@checkEmail')->name('post.checkEmail');
Route::get('/sign-in','HomeController@getSign_in')->name('get.sign_in');
Route::post('/sign-in','HomeController@postSign_in')->name('post.sign_in');
Route::get('/logout', 'HomeController@getLogout')->name('get.logout');
Route::get('/forgotpassword','HomeController@getForgotpassword')->name('get.forgotpassword');
Route::post('/sendmail','HomeController@sendMail')->name('post.sendmail');
Route::get('/changepassword/{token}/{id}', 'HomeController@getviewChangepassword')->name('get.changepassword');
Route::post('/changepassword/{token}/{id}', 'HomeController@Changepassword')->name('post.changepassword');
//user edit info
Route::group(['prefix' => '','middleware' => ['checklogin']], function() {
    Route::get('/changeavatar','HomeController@getviewChangeavatar')->name('get.changeavatar');
    Route::post('/changeavatar','HomeController@Changeavatar')->name('post.changeavatar');
    Route::get('/getchangepassword','HomeController@viewChangepass_user')->name('get.viewChangepass_user');
    Route::post('/getchangepassword','HomeController@Changepass_user')->name('post.changepassword_user');
});
// -------------------------------------------------------------------------------------------
//Admin
// Dashboard
Route::group(['prefix' => 'admin','middleware' => ['checklogin','checkadmin']], function() {
	Route::get('/','AdminController@index')->name('admin.index');
	//TheLoai
	Route::group(['prefix' => 'theloai'], function() {
		Route::get('/','TheloaiController@index')->name('theloai.index');
		Route::post('/store','TheloaiController@store')->name('post.theloai.store');
		Route::post('/checkstore','TheloaiController@checkstore')->name('post.theloai.checkstore');
		Route::get('/update/{id}','TheloaiController@getUpdate')->name('get.theloai.update');
		Route::post('/update/{id}','TheloaiController@update')->name('post.theloai.update');
		Route::get('/delete/{id}', 'TheloaiController@destroy')->name('get.theloai.delete');
	});
	//LoaiTin
	Route::group(['prefix' => 'loaitin'], function() {
		Route::get('/','LoaitinController@index')->name('loaitin.index');
		Route::post('/store','LoaitinController@store')->name('post.loaitin.store');
		Route::get('/update/{id}','LoaitinController@getUpdate')->name('get.loaitin.update');
		Route::post('/update/{id}','LoaitinController@update')->name('post.loaitin.update');
		Route::get('/delete/{id}', 'LoaitinController@destroy')->name('get.loaitin.delete');
	});
	//TinTuc
	Route::group(['prefix' => 'tintuc'], function() {
		Route::group(['prefix' => 'public'], function() {
			Route::get('/getviewhotnews','TintucController@gethotnews')->name('tintuc.getview.hotnews');
			Route::get('/postnew','TintucController@postnew')->name('tintuc.get.postnew');
			Route::get('/','TintucController@indexpublic')->name('tintuc.index.public');
			Route::get('/getviewhighlight','TintucController@gethighlightnews')->name('tintuc.getview.highlightnews');
			Route::post('/store','TintucController@storepublic')->name('post.tintuc.store');
			Route::get('/update/{id}','TintucController@getUpdate')->name('get.tintuc.update');
			Route::post('/update/{id}','TintucController@update')->name('post.tintuc.update');
			Route::get('/deletepublic/{id}','TintucController@destroypublic')->name('post.tintuc.destroypublic');
			Route::get('/highlight/{id}','TintucController@highlight')->name('get.tintuc.highlight');
			Route::get('/unhighlight/{id}','TintucController@unhighlight')->name('get.tintuc.unhighlight');
			Route::get('/hotnews/{id}','TintucController@hotnews')->name('get.tintuc.hotnews');
			Route::get('/unhotnews/{id}','TintucController@unhotnews')->name('get.tintuc.unhotnews');
			Route::get('/view/{id}','TintucController@viewtintuc')->name('get.tintuc.view');
		});
		Route::group(['prefix' => 'private'], function() {
			Route::get('/','TintucController@indexprivate')->name('tintuc.index.private');
			Route::get('/accept/{id}','TintucController@accept')->name('tintuc.accept.private');
			Route::get('/destroyprivate/{id}','TintucController@destroyprivate')->name('post.tintuc.destroyprivate');
		});
	});
	//User
	Route::group(['prefix' => 'user'], function() {
		Route::get('/','UserController@index')->name('user.index');
		Route::post('/store','UserController@store')->name('post.user.store');
		Route::get('/delete/{id}','UserController@destroy')->name('get.user.delete');
	});
	//Slide
	Route::group(['prefix' => 'slide'], function() {
	    Route::get('/','SlideController@index')->name('slide.index');
	    Route::get('/delete/{id}','SlideController@destroy')->name('slide.destroy');
	    Route::post('/store','SlideController@store')->name('slide.store');
	});
});

//-------------------------------------------------------------------------------------------
//Ctv
Route::group(['prefix' => 'ctv','middleware' => ['checklogin','checkctv']], function() {
    Route::get('/','CongTacVienController@index')->name('ctv.index');
    Route::post('/ctvpost','CongTacVienController@store')->name('ctv.store');
    Route::get('/view/{id}','CongTacVienController@show')->name('ctv.view');
    Route::get('/edit/{id}', 'CongTacVienController@getupdate')->name('ctv.get.update');
    Route::post('/edit/{id}','CongTacVienController@update')->name('ctv.post.update');
    Route::get('/delete/{id}','CongTacVienController@destroy')->name('ctv.get.delete');
});
