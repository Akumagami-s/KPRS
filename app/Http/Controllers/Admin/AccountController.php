<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Pangkat;
use App\User;
use App\Detailkpr;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use App\Exports\UserExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use DataTables;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    public function index()
    {
        $account = User::where('id', '!=', auth()->user()->id)->whereIn('role', ['0', '1'])->paginate(5);
        return view('admin.account.index', [
            'accounts' => $account
        ]);
    }

    public function admin_index_account()
    {
        Alert::warning('Informasi Pesan', 'Sedang Dalam Perbaikan');
        return back();
        // $data = Detailkpr::tmt_angsuran()->get();
        // $jumlahpinjaman = $tahunini->sum('pinjaman');
        // $totaltunggakan = $tahunini->sum('jml_tunggakan');

        // $account = User::where('id', '!=', auth()->user()->id)->where('role', '0')->paginate(5);
        // return view('admin.account.admin.index', [
        //     'accounts' => $account
        // ]);
    }

    public function pengelola_index_account()
    {
        if (request()->ajax()) {
            $accounts = DB::connection('login')->table('users')->where('id', '!=', auth()->user()->id)->where('role', '1');
            $datatables = DataTables::queryBuilder($accounts)
                ->editColumn('avatar', function($account){
                    if (empty($account->avatar)) {
                        return '<img class="rounded-circle" src="'. asset('assets/images/avatar/avatar-default.png'). '" width="60" alt="avatar">';
                    } else {
                        return '<img class="rounded-circle" src="'. "/storage/" . $account->avatar .'" style="width: 60px; height: 60px; object-fit: cover; object-position: center;" alt="avatar">';
                    }
                })->editColumn('password', function($account){
                    return '<span class="badge badge-light">DILINDUNGI<span>';
                })->addColumn('action', function($account){
                    return '
                        <a href="'. route('admin.account.register.edit', $account->id) .'" style="float: left;" class="mr-1"><i class="fa fa-pencil-square-o" style="color: rgb(0, 241, 12);"></i></a>
                        <button type="submit" onclick="deleteUser('.$account->id.')" style="background-color: transparent; border: none;"><i class="icon-trash" style="color: red;"></i></button>
                        <form action="'. route('admin.account.register.destroy', $account->id) .'" method="post" id="DeleteUser'.$account->id.'">
                            '.csrf_field().'
                            '.method_field("DELETE").'
                        </form>
                    ';
                })->rawColumns(['avatar', 'password', 'action'])->toJson();

            return $datatables;
        }
        // $account = User::where('id', '!=', auth()->user()->id)->where('role', '1')->paginate(5);
        return view('admin.account.kelola.index');
    }

    public function user_index_account()
    {
        // $detailkpr = Detailkpr::where('id', '!=', auth()->user()->id)->wherein('role', ['2', '3'])->paginate(5);

        // if (request()->ajax()) {
        //     $accounts = DB::table('users');
        //     $datatables = DataTables::queryBuilder($accounts)
        //         ->editColumn('email_verified_at', function($account){
        //             if ($account->email_verified_at == null) {
        //                 return '<span class="badge badge-danger">Belum Verifikasi Email</span>';
        //             } else {
        //                 return '<span class="badge badge-success">Sudah Verifikasi Email</span>';
        //             }
        //         })->editColumn('avatar', function($account){
        //             if (empty($account->avatar)) {
        //                 return '<img class="rounded-circle" src="'. asset('assets/images/avatar/avatar-default.png'). '" width="60" alt="avatar">';
        //             } else {
        //                 return '<img class="rounded-circle" src="'. $account->ImgProfile .'" style="width: 60px; height: 60px; object-fit: cover; object-position: center;" alt="avatar">';
        //             }
        //         })->editColumn('password', function($account){
        //             return '<span class="badge badge-light">DILINDUNGI<span>';
        //         })->addColumn('action', function($account){
        //             $form = '';
        //             if ($account->email_verified_at != null && $account->role == 3){
        //                 $form = '<div class="mb-2"><form action="'. route('admin.account.updaterole', $account->id) .'" method="post">
        //                     '.csrf_field().'
        //                     '.method_field("PATCH").'
        //                     <button class="btn btn-info btn-sm"><i class="fa fa-refresh"></i> UPDATE ROLE</button>
        //                 </form></div>';
        //             }
        //             return $form .'
        //                 <a href="'. route('admin.account.register.edit', $account->id) .'" style="float: left;" class="mr-1"><i class="fa fa-pencil-square-o" style="color: rgb(0, 241, 12);"></i></a>
        //                 <button type="submit" onclick="deleteUser('. "$account->id" .')" style="background-color: transparent; border: none;"><i class="icon-trash" style="color: red;"></i></button>
        //                 <form action="'. route('admin.account.register.destroy', $account->id) .'" method="post" id="DeleteUser'.$account->id.'">
        //                     '.csrf_field().'
        //                     '.method_field("DELETE").'
        //                 </form>
        //             ';
        //         })->rawColumns(['email_verified_at', 'avatar', 'password', 'action'])->toJson();

        //     return $datatables;
        // }

        if(request()->search) {
            $search = request()->search;
            $accounts = User::search($search)
                ->latest()->paginate(10);
        } else {
            $accounts = User::where('id', '!=', auth()->user()->id)->whereIn('role', ['2', '3'])->latest()->paginate(10);
        }

        return view('admin.account.user.index', compact('accounts'));
    }

    public function verifikasi_index_account()
    {
        // $account = User::where('id', '!=', auth()->user()->id)->where('status_verif', null || 0)->where('email_verified_at', '!=', null)->whereIn('role', ['3'])->paginate(5);

        if (request()->ajax()) {
            $accounts = DB::connection('login')->table('users')->where('id', '!=', auth()->user()->id)->where('status_verif', null || 0)->where('email_verified_at', '!=', null)->whereIn('role', ['3']);
            $datatables = DataTables::queryBuilder($accounts)
                ->editColumn('role', function($account){
                    if ($account->role == '0') {
                        return '<span class="badge badge-success">ADMIN</span>';
                    } else if ($account->role == '1') {
                        return '<span class="badge badge-warning">PENGELOLA</span>';
                    } else if ($account->role == '2') {
                        return 'USER';
                    } else if ($account->role == '3') {
                        return 'ENDUSER';
                    } else {
                        return 'Not Have Role';
                    }
                })->editColumn('avatar', function($account){
                    if (empty($account->avatar)) {
                        return '<img class="rounded-circle" src="'. asset('assets/images/avatar/avatar-default.png'). '" width="60" alt="avatar">';
                    } else {
                        return '<img class="rounded-circle" src="'. $account->ImgProfile .'" style="width: 60px; height: 60px; object-fit: cover; object-position: center;" alt="avatar">';
                    }
                })->editColumn('password', function($account){
                    return '<span class="badge badge-light">DILINDUNGI<span>';
                })->addColumn('action', function($account){
                    return '
                        <form action="'. route('admin.account.verified', $account->id) .'" method="post">
                            '.csrf_field().'
                            '.method_field("PATCH").'
                            <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-check"></i> VERIFIED</button>
                        </form>
                    ';
                })->rawColumns(['role', 'avatar', 'password', 'action'])->toJson();

            return $datatables;
        }

        return view('admin.account.verifikasi.index');
    }

    public function update_role($id)
    {
        User::findOrFail($id)->update([
            'role' => '2'
        ]);

        Alert::success('Informasi Pesan', 'Role berhasil di update');
        return back();
    }
    public function krp_update_profile_user(Request $request)
    {
        Detailkpr::create([
            "nama" => $request->nama,
            "nrp" => $request->nrp,
            "pangkat" => $request->pangkat,
            "corps" => $request->corps,
            "kesatuan" => $request->kesatuan,
            "tahap" => $request->tahap,
            'status' => 0
        ]);

        Alert::success('Informasi Pesan', 'Role berhasil di update');

        return back();
    }

    public function verified($id)
    {
        User::findOrFail($id)->update([
            'role' => '2',
            'status_verif' => '1'
        ]);
        Alert::success('Informasi Pesan', 'User berhasil di Verifikasi');
        return back();
    }

    public function store()
    {
        $attr = $this->validate(request(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'nrp' => ['required', 'string', 'min:3', 'max:255', 'unique:users,nrp'],
            'password' => ['required', 'min:3'],
            'role' => ['required'],
            'avatar' => ['mimes:png,jpg,jpeg,svg', 'max:2048']
        ]);
        $attr['password'] = bcrypt(request('password'));
        $thumb = request()->file('avatar') ? request()->file('avatar')->store("images/avatar") : null;
        $attr['avatar'] = $thumb;
        User::create($attr);
        Alert::success('Informasi Pesan', $this->role_definition() . ' baru berhasil di simpan');
        return back();
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.account.edit', compact('user'));
    }

    public function update($id)
    {
        $attr = $this->validate(request(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
            // 'nrp' => ['required', 'min:3', 'string', 'max:255', 'unique:users,nrp,' . $id],
            'avatar' => ['mimes:png,jpg,jpeg,svg', 'max:2048']
        ]);
        $user = User::findOrFail($id);
        if ($user->avatar == null) {
            if (request()->file('avatar')) {
                $thumbnail = request()->file('avatar')->store("images/avatar");
            } else {
                $thumbnail = null;
            }
        } else {
            if (request()->file('avatar')) {
                \Storage::delete($user->avatar);
                $thumbnail = request()->file('avatar')->store("images/avatar");
            } else {
                $thumbnail = $user->avatar;
            }
        }
        $attr['avatar'] = $thumbnail;
        $user->update($attr);
        Alert::success('Informasi Pesan', $this->role_definition() . ' ' . request('name') . ' berhasil di update');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->avatar) {
            \Storage::delete($user->avatar);
        }
        $user->delete();
        Alert::success('Informasi Pesan', $this->role_definition() . ' ' . $user->name . ' berhasil di hapus');
        return back();
    }

    protected function role_definition()
    {

        if(request('role') == 0)
        {
            return 'Admin';
        } else {
            return 'Pengelola';
        }
    }

    public function search_admin()
    {
        $query = request('query');
        $account = User::where('role', '0')->where("name", "like", "%$query%")
            ->orWhere("email", "like", "%$query%")
            ->orWhere("nrp", "like", "%$query%")
            ->latest()->paginate(3);
        return view('admin.account.admin.index', [
            'accounts' => $account
        ]);
    }

    public function search_pengelola()
    {
        $query = request('query');
        $account = User::where('role', '1')->where("name", "like", "%$query%")
            ->orWhere("email", "like", "%$query%")
            ->orWhere("nrp", "like", "%$query%")
            ->latest()->paginate(3);
        return view('admin.account.kelola.index', [
            'accounts' => $account
        ]);
    }

    public function userExportExcel()
    {
        ob_end_clean();
        ob_start();

        $search = '';

        if (request()->search != null) {
            $search = request()->search;
        }

        return Excel::download(new UserExport($search), 'Data User Kpr.xlsx');
    }

    public function userExportPdf()
    {
        $user = Detailkpr::all();
        $pdf = PDF::loadview('admin.account.report_user_pdf',[
            'pinjams' => $user
        ]);
        return $pdf->stream();
    }

}
