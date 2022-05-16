<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hospital;
use App\Models\District;
use App\Models\Thana;
use Illuminate\Support\Facades\Validator;

class HospitalController extends Controller
{
    public function hospitalList(Request $request) {
        
        $list = Hospital::with('districts', 'thanas')->get();    
        return response()->json($list,200);
    }

    public function searchHospital(Request $request) {
        $hospital_name = $request->get('hospital_name');
        $district      = $request->get('district');
        $thana         = $request->get('thana');
        $list = Hospital::with('districts', 'thanas')
                ->where('hospital_name', 'like', '%'.$hospital_name.'%')
                ->where('district_id', 'like', '%'.$district.'%')
                ->where('thana_id', 'like', '%'.$thana.'%')
                ->get();       
        return response()->json($list,200);
    }

    public function getDistrict() {
        $districts = District::get();
        return response()->json($districts);
    }

    public function getThana(Request $request, $district_id) {
        $thanas = Thana::where('district_id', $district_id)->get();
        return response()->json($thanas);
    }

    public function addHospital(Request $request) {
        $validation = Validator::make($request->all(),[
            'hospital_name' => 'required|min:3',
            'phone'         => 'required'
        ]);

        if(!$validation->fails()) {
            $add = Hospital::create([
               'hospital_name'  => $request->hospital_name,
               'hospital_order' => $request->hospital_order,
               'district_id'    => $request->district_id,
               'thana_id'       => $request->thana_id,
               'email'          => $request->email,
               'phone'          => $request->phone,
               'status'         => $request->status
            ]);

            if($add) {
                return response()->json(200);
            }
        }else{
            return response()->json(['errors' => $validation->errors()],401);
        }
    }

    public function singleHospital(Request $request, $id) {
        $data['list']   = Hospital::with('districts','thanas')->where('id', $id)->first();
        $data['thanas'] = Thana::where('district_id',$data['list']->district_id)->get();
        return response()->json($data,200);
    }

    public function updateHospital(Request $request, $id) {
        $validation = Validator::make($request->all(),[
            'hospital_name' => 'required|min:3',
            'phone'         => 'required'
        ]);

        if(!$validation->fails()) {
            $update = Hospital::where('id', $id)->update([
               'hospital_name'  => $request->hospital_name,
               'hospital_order' => $request->hospital_order,
               'district_id'    => $request->district_id,
               'thana_id'       => $request->thana_id,
               'email'          => $request->email,
               'phone'          => $request->phone,
               'status'         => $request->status
            ]);

            if($update) {
                return response()->json(200);
            }
        }else{
            return response()->json(['errors' => $validation->errors()],401);
        }
    }

    public function deleteHospital(Request $request, $id) {
        $delete = Hospital::destroy(array('id',$id));

        if($delete) {
           return response()->json(200);
        }else{
            return response()->json(401);
        }
    }
}
