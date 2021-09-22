<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Transaksi;
use App\Http\Controllers\RekapanbtnController;

// DARI SERVER DEV


// login & register
Route::get('cache', function(){
    Artisan::call('optimize:clear');
    Artisan::call('storage:link');
});


Route::middleware('ssocheck')->group(function () {
    Route::get('/', function () {
        return view('index');
    })->name('index');




    Route::get('/laporans', function(){

        $index = DB::table('kpr')->get();
        foreach($index as $item){
            $ceks = DB::table('users')->where('nrp',$item->nrp)->first();

            dd($item);
            // if(empty($ceks)){
            //     DB::table('users')->insert([
            //                     'name' => $item->nama,
            //                     'nrp' => $item->nrp,
            //                     'password' => bcrypt('twpad2022'),
            //                     'role' => '2',
            //                     'status_verif' => '1',
            //                     'pangkat' => $item->pangkat,
            //                 ]);
            //     echo $item->nrp.'<br>';
            // }
        }
        dd('ceks');
        /*$index = DB::table('kpr_import_V03')->get();
        echo 'nama' . ';' .'pangkat'. ';' .'corps'. ';' .'nrp'. ';' .'kesatuan'. ';' .'kotama'. ';' .'alamat'. ';' .'tahap'. ';' .'pinjaman'. ';' .'jk_waktu'. ';' .'tmt_angsuran'. ';' .'jml_angs'. ';' .'angs_ke'. ';' .'angsuran_masuk'. ';' .'angs_masuk_btn'. ';' .'angs_masuk_manual'. ';' .'tunggakan'. ';' .'jml_tunggakan'. ';' .'tunggakan_pokok'. ';' .'tunggakan_bunga'. ';' .'keterangan'. ';' .'rekening'. ';' .'rekening_kredit'. ';' .'nama_bank'. ';' .'rek_bri'. ';' .'rek_btn'. ';' .'status' . ';' .'bunga'. ';' .'pokok'. ';' .'sisa_pinjaman_pokok'. ';' .'inisial_bunga'. ';' .'inisial_pokok'. ';' .'piutang_bunga'. ';' .'piutang_pokok'. ';' .'ktp'.'<br>';
        foreach($index as $cek){
            $ceks = DB::table('kpr')->where('nrp',$cek->nrp)->first();
            echo $ceks->nama . ';' .$ceks->pangkat . ';' .$ceks->corps . ';' .$ceks->nrp . ';' .$ceks->kesatuan . ';' .$ceks->kotama . ';' .$ceks->alamat . ';' .$ceks->tahap . ';' .$ceks->pinjaman . ';' .$ceks->jk_waktu . ';' .$ceks->tmt_angsuran . ';' .$ceks->jml_angs . ';' .$ceks->angs_ke . ';' .$ceks->angsuran_masuk . ';' .$ceks->angs_masuk_btn . ';' .$ceks->angs_masuk_manual . ';' .$ceks->tunggakan . ';' .$ceks->jml_tunggakan . ';' .$ceks->tunggakan_pokok . ';' .$ceks->tunggakan_bunga . ';' .$ceks->keterangan . ';' .$ceks->rekening . ';' .$ceks->rekening_kredit . ';' .$ceks->nama_bank . ';' .$ceks->rek_bri . ';' .$ceks->rek_btn . ';' .$ceks->status . ';' .$ceks->bunga . ';' .$ceks->pokok . ';' .$ceks->sisa_pinjaman_pokok . ';' .$ceks->inisial_bunga . ';' .$ceks->inisial_pokok . ';' .$ceks->piutang_bunga . ';' .$ceks->piutang_pokok . ';' .$ceks->ktp.'<br>';
        }*/

    });

    //Query Import trxbri
    Route::get('/trxbri', function(){
        dd('sudah');
        $index = DB::table('kpr_import_V03')->where('ket',NULL)->get();
        foreach($index as $item){
            $ceks = DB::table('kpr_asli')->where('nrp',$item->nrp)->first();
            DB::table('TrxBri')->insert([
                                'nrp' => $ceks->nrp,
                                'kodecabang' => '0018',
                                'tanggal' => "2021-08-22",
                                'rekeningdebet' => $ceks->nrp,
                                'matauang' => 'IDR',
                                'amountdebet' => $ceks->jml_angs,
                                'status' => '0001',
                                'deskripsi' => 'Transaction Successful',
                                'nama' => $ceks->nama,
                            ]);
            DB::table('kpr_import_V03')->where('nrp',$item->nrp)->update([
                    'ket'=>'sudah',
                    ]);
        }
    dd('end');
    });

    //Query Buat Benerin Database dari twp
    Route::get('/inject_data', function(){
        $ceks = DB::table('kpr_import_V03')->where('ket',NULL)->take(2000)->get();
        $get = DB::table('kpr_import_V03')->count();
        $get_total= DB::table('kpr_import_V03')->where('ket','sudah')->count();
        foreach($ceks as $item){
            $date = date('Y-m-d');
            $data = DB::table('kpr')->where('nrp',$item->nrp)->first();
            if(empty($data->nrp)){
                echo $item->nrp .  'data tidak ada <br>' ;
                continue;
            }
        DB::table('TrxBri')->insert([
                                'nrp' => $data->nrp,
                                'kodecabang' => '0018',
                                'tanggal' => $date,
                                'rekeningdebet' => $data->nrp,
                                'matauang' => 'IDR',
                                'amountdebet' => $data->jml_angs,
                                'status' => '0001',
                                'deskripsi' => 'Transaction Successful',
                                'nama' => $data->nama,
                            ]);

             if($data->angs_ke == ($item->jml_bln+1)){
                 if($data->angs_ke != $data->angsuran_masuk){
                     DB::table('kpr')->where('nrp',$data->nrp)->update([
                     'angsuran_masuk'=>DB::raw('angsuran_masuk+1'),
                     'tunggakan'=> DB::raw('tunggakan-1'),
                     'jml_tunggakan'=> DB::raw('jml_tunggakan-jml_angs'),
                     ]);
                 }
             }
             if($data->angs_ke < ($item->jml_bln+1)){
                 DB::table('kpr')->where('nrp',$data->nrp)->update([
                     'angsuran_masuk'=>DB::raw('angsuran_masuk+1'),
                     'angs_ke'=>DB::raw('angs_ke+1')
                     ]);
             }
             DB::table('kpr_import_V03')->where('nrp',$data->nrp)->update([
                     'ket'=>'sudah',
                     ]);
        }
        if(empty($get)){
            dd('Data Tidak Ada');
        }elseif($get_total == $get){
            dd('Data dalam table Import Sudah Di Update');
        }
        elseif($get_total != $get){
            dd('Refresh Kembali Untuk menyelesaikan update data');
        }
    });

    Route::post('refresh/puitang', 'HomeController@refresh_piutang')->name('refresh.piutang');
    Route::post('refresh/saldo', 'HomeController@refresh_saldo')->name('refresh.saldo');

    Auth::routes(['verify' => true]);

    Route::middleware(['auth', 'singlesession', 'prevent-back-history'])->group(function () {
        Route::prefix('detaildata')->name('detaildata.')->group(function () {
            Route::get('/all/{nrp}', 'Admin\HistoryController@all')->name('all');
            Route::get('/success/{nrp}', 'Admin\HistoryController@success')->name('success');
            Route::get('/decline/{nrp}', 'Admin\HistoryController@decline')->name('decline');
        });
        // Darkmode
        Route::post('/darkmode', 'UserController@darkmode')->name('darkmode');
        // dashboard
        Route::get('/home', 'HomeController@index')->name('home');
        // profil user
        Route::prefix('profile')->name('profile.')->group(function () {
            Route::get('/setting', 'UserController@edit')->name('setting');
            Route::patch('/setting/update', 'UserController@update')->name('update');
        });
        // change password
        Route::prefix('account')->name('password.')->group(function () {
            Route::get('/password', 'UserController@changePassword')->name('edit');
            Route::patch('/password', 'UserController@updatePassword')->name('edit');
        });
         // user pinjam
        Route::resource('userpinjam', 'User\PinjamanController')->except('refresh_jmlangs')->middleware('checkRole:2,3');
        Route::get('userpinjam/create/{id}', 'User\PinjamanController@createRumah')->name('userpinjam.rumah');
        Route::get('/show/{id}', 'HomeController@show')->name('show');
        Route::post('userpinjam/data-kesatuan', 'User\PinjamanController@dataKesatuan')->name('userpinjam.data-kesatuan');
        Route::get('lihat/jmlangs', 'User\PinjamanController@refresh_jmlangs')->name('lihat.jmlangs');
        Route::prefix('pinjaman')->name('pinjaman.')->namespace('User')->group(function () {
            Route::post('/set', 'MenuController@set')->name('set');
            Route::get('/get', 'MenuController@get')->name('get');
            Route::post('/store', 'MenuController@store')->name('store');
        });
        Route::get('/user/pdf/{id}','Admin\DetaildataController@approve_pdf')->name('approve.pdf')->middleware('checkRole:2,3');
        // admin
        Route::prefix('admin')->name('admin.')->middleware('checkRole:0,1')->namespace('Admin')->group(function () {
            Route::get('/search/data_kpr', 'DetaildataController@search_data_kpr')->name('search.kpr');
            Route::get('/search/data_manual', 'DetaildataController@search_data_manual')->name('search.manual');
            // rumah
            Route::resource('rumah', 'RumahController');
            // fasilitas
            Route::resource('fasilitas', 'FasilitasController');
            // management pengajuan
            Route::prefix('pengajuan')->name('pengajuan.')->group(function () {
                Route::get('/', 'PengajuanController@index')->name('index');
                Route::patch('/confirmation/{id}', 'PengajuanController@confirmation')->name('confirmation');
            });
            // management account
            Route::prefix('account')->name('account.')->group(function () {
                // per view & role
                Route::get('/admin', 'AccountController@admin_index_account')->name('admin');

                Route::get('/user', 'AccountController@user_index_account')->name('customer');
                Route::patch('/user/updateprofile', 'AccountController@krp_update_profile_user')->name('update.profile');

                Route::get('/pengelola', 'AccountController@pengelola_index_account')->name('pengelola');
                Route::patch('/updaterole/{id}', 'AccountController@update_role')->name('updaterole');
                // register account
                Route::resource('register', 'AccountController');
                Route::get('/verifikasi', 'AccountController@verifikasi_index_account')->name('verifikasi');
                Route::patch('/verified/{id}', 'AccountController@verified')->name('verified');
                Route::get('/search/admin', 'AccountController@search_admin')->name('search.admin');
                Route::get('/search/pengelola', 'AccountController@search_pengelola')->name('search.pengelola');
                Route::get('/user/export/excel', 'AccountController@userExportExcel')->name('user.export.excel');
                Route::get('/user/export/pdf', 'AccountController@userExportPdf')->name('user.export.pdf');
            });
            Route::prefix('rekapdata')->name('rekapdata.')->group(function () {
                Route::get('/Bulan', 'RekapdataController@getBulan')->name('bulan');
                Route::get('/Tahun', 'RekapdataController@getTahun')->name('tahun');
            });
            Route::prefix('detaildata')->name('detaildata.')->group(function () {
                Route::get('/report/global', 'DetaildataController@DetailkprExportExcel')->withoutMiddleware('prevent-back-history')->name('report.global');
                //update
                Route::prefix('update')->name('update.')->group(function(){
                    Route::get('/{id}','UpdateController@edit')->name('edit');
                    Route::post('/{id}/update', 'UpdateController@store')->name('store');
                    Route::post('/meninggal/{id}', 'UpdateController@meninggal')->name('meninggal');
                    Route::post('/lunas/{id}', 'UpdateController@lunas')->name('lunas');
                });
                Route::get('
                /RekapBulanan', 'DetaildataController@RekapbulananExportExcel')->withoutMiddleware('prevent-back-history')->name('rekapbulanan');

                Route::get('/cari', 'DetaildataController@cari')->name('cariid');
                Route::get('/AngsuranKe', 'DetaildataController@getAngsuranKe')->name('angsuranke');
                Route::get('/Pokok', 'DetaildataController@getPokok')->name('pokok');
                Route::get('/Bunga', 'DetaildataController@getBunga')->name('bunga');
                Route::get('/BesarAngsuran', 'DetaildataController@getBesarAngsuran')->name('besarangsuran');
                Route::get('/SisaAngsuran', 'DetaildataController@getSisaAngsuran')->name('sisaangsuran');
                Route::get('/{pinjam}', 'DetaildataController@getindex')->name('pinjam');
                Route::put('/status/{pinjam}', 'DetaildataController@statusupdate')->name('status');
                Route::put('/decline/{pinjam}', 'DetaildataController@statusdecline')->name('statusdecline');
                Route::get('/show/{id}', 'DetaildataController@show')->name('show');
                Route::get('/approve/pdf/{id}','DetaildataController@approve_pdf')->name('approve.pdf');
                Route::get('/refresh/saldo', 'DetaildataController@refresh_saldo')->name('refreshsaldo');
                Route::get('/refresh/piutang', 'DetaildataController@refresh_piutang')->name('refreshpiutang');
                Route::put('/refresh/hutangdetail/{id}', 'DetaildataController@refresh')->name('refresh');
                Route::post('/{pinjam}/all-data/datatables/api', 'DetaildataController@datatablesGetIndex')->name('datatables');
                Route::get('/riwayat/{nrp}', 'HistoryController@index')->name('history');
                Route::get('/all/{nrp}', 'HistoryController@all')->name('all');
                Route::get('/success/{nrp}', 'HistoryController@success')->name('success');
                Route::get('/decline/{nrp}', 'HistoryController@decline')->name('decline');

            });

            Route::resource('pangkat', 'PangkatController');
        });

    });











});




//Kalo mau ngubah Back-Endnya comment dulu abort(404); di bawah ini trus kalo udah hapus lagi commentnya
//abort(404);
// Route::middleware('guest')->group(function () {
    // user landing page
    // Route::get('/', function () {
    //     return view('index');
    // })->name('index');
    // Route::get('/register', function () {
    //     return view('auth.register');
    // });
    // Route::get('/login', function () {
    //     return view('auth.login');
    // });
    // Route::prefix('user')->namespace('User')->name('user.')->group(function () {
    //     Route::get('/register', 'RegisterUser@index')->name('register');
    // });
// });


//Route::prefix('rekap')->name('rekap')->group(function () {
//});

//Route::get('/rekapanbtn', [RekapanbtnController::class, 'index']);




Route::get('/kalkulator', 'HomeController@kalkulator')->name('kalkulator');
Route::post('/hitung', 'HomeController@HitungKalkulator')->name('hitung');

Route::prefix('sandbox')->name('sandbox.')->group(function () {
    Route::get('/', 'SandboxController@index')->name('index');
    Route::post('/createKpr', 'SandboxController@createKpr')->name('createKpr');
    Route::post('/bayarPost', 'SandboxController@bayarPost')->name('bayarPost');
    Route::get('/datapinjam', 'SandboxController@lihatDataBayar')->name('datapinjam');
});
Route::get('bulk_upload', 'CoreController@bulk_upload')->name('bulk_upload');
Route::post('store_bulk', 'CoreController@store_bulk')->name('store_bulk');


Route::prefix('locate')->name('locate.')->group(function () {
    Route::get('/index', 'PositionController@index')->name('index');
    Route::get('/categorySearch', 'PositionController@categorySearch')->name('categorySearch');
});

