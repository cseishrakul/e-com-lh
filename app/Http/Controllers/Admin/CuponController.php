<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;

class CuponController extends Controller
{
    public function __construct()
    {   
        $this->middleware('auth');
        
    }

    public function index(Request $request){
        if($request->ajax()){
            $data = DB::table('cupons')->latest()->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action',function($row){
                $actionBtn = '<a href="" class="btn btn-info edit" data-id="'.$row->id.'" data-toggle="modal" data-target="#editModal"> <i class="fas fa-edit"></i> </a>
                <a href="'.route('cupon.delete',[$row->id]).'" class="btn btn-danger" id="delete_cupon"> <i class="fas fa-trash"></i> </a>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.offer.cupon.index');
    }

    // Cupon Delete Method 

    public function delete($id){
        DB::table('cupons')->where('id',$id)->delete();

        return response()->json('Cupon Deleted!');
    }

    // Cupon Add
    public function store(Request $request){
        $data = array(
            'cupon_code' => $request->cupon_code,
            'type' => $request->type,
            'cupon_amount' => $request->cupon_amount,
            'valid_date' => $request->valid_date,
            'status' => $request->status,
        );
        DB::table('cupons')->insert($data);
        return response()->json('Cupon Stored!');
    }

    // Cupon Edit

    public function edit($id){
        $data = DB::table('cupons')->where('id',$id)->first();
        return view('admin.offer.cupon.edit',compact('data'));
    }

    // Cupon Update
    public function update(Request $request){
        $data = array(
            'cupon_code' => $request->cupon_code,
            'type' => $request->type,
            'cupon_amount' => $request->cupon_amount,
            'valid_date' => $request->valid_date,
            'status' => $request->status,
        );
        DB::table('cupons')->where('id',$request->id)->update($data);
        return response()->json('Cupon Updated!');
    }
}
