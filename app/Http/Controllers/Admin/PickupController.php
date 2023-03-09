<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;

class PickupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
        if($request->ajax()){
            $data = DB::table('pickup_point')->latest()->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $actionBtn = '<a href="#" class="btn btn-info edit" data-id="'.$row->id.'" data-toggle="modal" data-target="#editModal"> <i class="fas fa-edit"></i> </a>
                <a href="'.route('pickuppoint.delete',[$row->id]).'" class="btn btn-danger" id="delete_pickup"> <i class="fas fa-trash"></i> </a>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('admin.pickupPoint.index');
    }

    public function store(Request $request){
        $data = array(
            'pickup_point_name' => $request->pickup_point_name,
            'pickup_point_address' => $request->pickup_point_address,
            'pickup_point_phone' => $request->pickup_point_phone,
            'pickup_point_phone_two' => $request->pickup_point_phone_two,
        );
        DB::table('pickup_point')->insert($data);
        return response()->json('successfully Inserted!');
    }

    public function delete($id){
        DB::table('pickup_point')->where('id',$id)->delete();
        return response()->json('Deleted!');
    }

    public function edit($id){
        $data =DB::table('pickup_point')->where('id',$id)->first();
        return view('admin.pickupPoint.edit',compact('data'));
    }

    public function update(Request $request){
        $data = array(
            'pickup_point_name' => $request->pickup_point_name,
            'pickup_point_address' => $request->pickup_point_address,
            'pickup_point_phone' => $request->pickup_point_phone,
            'pickup_point_phone_two' => $request->pickup_point_phone_two,
        );
        DB::table('pickup_point')->where('id',$request->id)->update($data);
        return response()->json('Pickup Point Updated');
    }
}
