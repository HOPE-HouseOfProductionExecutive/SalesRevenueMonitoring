<?php

namespace App\Http\Controllers;

use App\Models\Revenue;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use NumberFormatter;

class DataController extends Controller
{
    public function getTotalSPV() {
        $year = Carbon::now()->format('Y');

        $data1 = DB::table('revenues')
            ->select(DB::raw('SUM(total) as total, month'))
            ->where('spv', '=', 'Andry Setiawan')
            ->where('year', '=', $year)
            ->groupBy('month')
            ->get();
        $data2 = DB::table('revenues')
            ->select(DB::raw('SUM(total) as total, month'))
            ->where('spv', '=', 'Debby Tri')
            ->where('year', '=', $year)
            ->groupBy('month')
            ->get();
        $data3 = DB::table('revenues')
            ->select(DB::raw('SUM(total) as total, month'))
            ->where('spv', '=', 'Emihl Rembo')
            ->where('year', '=', $year)
            ->groupBy('month')
            ->get();
        $data4 = DB::table('revenues')
            ->select(DB::raw('SUM(total) as total, month'))
            ->where('spv', '=', 'Fransiscus Yura')
            ->where('year', '=', $year)
            ->groupBy('month')
            ->get();
        $data5 = DB::table('revenues')
            ->select(DB::raw('SUM(total) as total, month'))
            ->where('spv', '=', 'Fredericksen')
            ->where('year', '=', $year)
            ->groupBy('month')
            ->get();
        $data6 = DB::table('revenues')
            ->select(DB::raw('SUM(total) as total, month'))
            ->where('spv', '=', 'Fredy Mercury')
            ->where('year', '=', $year)
            ->groupBy('month')
            ->get();

        return response()->json([
            'data1' => $data1,
            'data2' => $data2,
            'data3' => $data3,
            'data4' => $data4,
            'data5' => $data5,
            'data6' => $data6,
        ], 200);
    }

    public function goToDashboard() {
        $data = Revenue::all();

        $new = Revenue::sum('new');
        $upgrade = Revenue::sum('upgrade');
        $churn = Revenue::sum('churn');
        $downgrade = Revenue::sum('downgrade');

        $countNew = 0;
        $countUpgrade = 0;
        $countChurn = 0;
        $countDowngrade = 0;

        foreach ($data as $value) {
            if($value->new != 0) {
                $countNew ++;
            }
            if($value->upgrade != 0) {
                $countUpgrade ++;
            }
            if($value->downgrade != 0) {
                $countDowngrade ++;
            }
            if($value->churn != 0) {
                $countChurn ++;
            }
        }
        $numberFormatter = new NumberFormatter("en_US", NumberFormatter::CURRENCY);
        $new = $numberFormatter->formatCurrency($new, 'IDR');
        $upgrade = $numberFormatter->formatCurrency($upgrade, 'IDR');
        $downgrade = $numberFormatter->formatCurrency($downgrade, 'IDR');
        $churn = $numberFormatter->formatCurrency($churn, 'IDR');

        return view('page.dashboard', compact([
            'data',
            'new',
            'upgrade',
            'churn',
            'downgrade',
            'countNew',
            'countUpgrade',
            'countChurn',
            'countDowngrade'
        ]));
    }

    public function getData() {
        $data = Revenue::orderBy('month', 'asc')->get();
        return view('page.data', [ 'data'=>$data ]);
    }

    public function getDataJson() {
        $data = Revenue::orderBy('month', 'asc')->get();
        return response()->json($data);
    }

    public function addDataRevenue(Request $req) {
        $req->validate([
            'name' => 'required',
            'spv' => 'required',
            'month' => 'required',
            'new' => 'required',
            'upgrade' => 'required',
            'churn' => 'required',
            'downgrade' => 'required',
        ]);

        $rev = new Revenue();
        $rev->name = $req->name;
        $rev->spv = $req->spv;
        $rev->month = $req->month;
        $rev->new = $req->new;
        $rev->upgrade = $req->upgrade;
        $rev->churn = $req->churn;
        $rev->downgrade = $req->downgrade;

        $total = ($req->new + $req->upgrade) - ($req->downgrade + $req->churn);
        $rev->total = $total;

        $rev->save();
        return redirect()->back();
    }

    public function removeDataRevenue(Request $req) {
        $data = Revenue::find($req->ids);
        // dd($data);
        $data->delete();
        return redirect()->back();
    }

    public function updateDataRevenue(Request $req) {
        $req->validate([
            'name' => 'required',
            'spv' => 'required',
            'month' => 'required',
            'new' => 'required',
            'upgrade' => 'required',
            'churn' => 'required',
            'downgrade' => 'required',
        ]);
        $data = Revenue::find($req->ids);
        $data->name = $req->name;
        $data->spv = $req->spv;
        $data->month = $req->month;
        $data->new = $req->new;
        $data->upgrade = $req->upgrade;
        $data->churn = $req->churn;
        $data->downgrade = $req->downgrade;

        $data->save();
        return redirect()->back();
    }

    public function addUserData(Request $req) {
        $req->validate([
            'name' => 'required',
            'email' => 'required|email',
            'role' => 'required',
            'gender' => 'required',
            'photo' => 'image',
        ]);
        $file = $req->file('photo');

        $img_name = '';

        if($file != null) {
            $img_name = 'profile_photo_'.time().'.'.$file->getClientOriginalExtension();
            Storage::putFileAs('public/assets/image', $file, $img_name);
            $img_name = 'assets/image/'.$img_name;
        }
        else {
            if($req->gender == 'Male') {
                $img_name = 'assets/image/default_male.svg';
            }
            else {
                $img_name = 'assets/image/default_female.svg';
            }
        }


        $data = new User();
        $data->name = $req->name;
        $data->email = $req->email;
        $data->role_id = $req->role_id;
        $data->gender = $req->gender;
        $data->photo_path = $img_name;
        $data->password= Hash::make('csojatabek123');


        $data->save();

        return redirect()->back();
    }

}
