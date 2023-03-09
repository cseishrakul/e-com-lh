<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;
use DataTables;
use DB;
use App\Mail\RecievedMail;
use Mail;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
        if($request->ajax()){
            $imageUrl = 'public/files/product';
            $order ="";
              $query=DB::table('orders')->orderBy('id','DESC');

                if ($request->payment_type) {
                    $query->where('payment_type',$request->payment_type);
                 }
                if ($request->date) {
                    $order_date = date('d-m-Y', strtotime($request->date));
                    $query->where('date',$order_date);
                 }
                if ($request->status==0) {
                    $query->where('status',0);
                 }
                if ($request->status==1) {
                    $query->where('status',1);
                 }
                if ($request->status==2) {
                    $query->where('status',2);
                 }
                if ($request->status==3) {
                    $query->where('status',3);
                 }
                if ($request->status==4) {
                    $query->where('status',4);
                 }
                if ($request->status==5) {
                    $query->where('status',5);
                 }
                

            $order = $query->get();
            return DataTables::of($order)
                    ->addIndexColumn()
                    ->editColumn('status', function($row){
                        if($row->status == 0){
                            return ' <span class="badge badge-danger"> Pending </span> ';
                        }elseif($row->status == 1){
                            return ' <span class="badge badge-primary"> Recieved </span> ';
                        }elseif($row->status == 2){
                            return ' <span class="badge badge-info"> Shipped </span> ';
                        }elseif($row->status == 3){
                            return ' <span class="badge badge-success"> Completed </span> ';
                        }elseif($row->status == 4){
                            return ' <span class="badge badge-warning"> Return </span> ';
                        }else{
                            return ' <span class="badge badge-danger"> Cancel </span> ';
                        }
                    })
                    ->addColumn('action', function($row){
                        $actionbtn = '<a href="#" data-id="'.$row->id.'" class="btn btn-info btn-sm edit" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i></a>
                        <a href="#" data-id="'.$row->id.'" class="btn btn-info btn-sm view" data-toggle="modal" data-target="#viewModal"> <i class="fas fa-eye"></i> </a>
                        <a href="'.route('order.delete',[$row->id]).'" class="btn btn-danger btn-sm" id="delete_product"> <i class="fas fa-trash"></i> </a>';
                        return $actionbtn;
                    })
                    ->rawColumns(['action','status'])
                    ->make(true);
        }
        return view('admin.order.index');
    }

    public function edit($id){
        $order = DB::table('orders')->where('id',$id)->first();
        return view('admin.order.edit',compact('order'));
    }

    public function updateStatus(Request $request){
        $data = array();
        $data['c_name'] = $request->c_name;
        $data['c_email'] = $request->c_email;
        $data['c_phone'] = $request->c_phone;
        $data['c_address'] = $request->c_address;
        $data['status'] = $request->status;

        if($request->status == 1){
            Mail::to($request->c_email)->send(new RecievedMail($data));
        }
        DB::table('orders')->where('id',$request->id)->update($data);
        return response()->json('Successfully Changed Order!');
    }

    public function viewOrder($id){
        $order = DB::table('orders')->where('id',$id)->first();
        $order_detail = DB::table('order_details')->where('order_id',$id)->get();
        return view('admin.order.order_details',compact('order','order_detail'));
    }

    public function delete($id){
        $order = DB::table('orders')->where('id',$id)->delete();
        $order_detail = DB::table('order_details')->where('order_id',$id)->delete();
        $notification = array('message' => 'Order Deleted!','alert-type' => 'success');

        return redirect()->back()->with($notification);
    }


    public function reportIndex(Request $request){
        if($request->ajax()){
            $imageUrl = 'public/files/product';
            $order ="";
              $query=DB::table('orders')->orderBy('id','DESC');

                if ($request->payment_type) {
                    $query->where('payment_type',$request->payment_type);
                 }
                if ($request->date) {
                    $order_date = date('d-m-Y', strtotime($request->date));
                    $query->where('date',$order_date);
                 }
                if ($request->status==0) {
                    $query->where('status',0);
                 }
                if ($request->status==1) {
                    $query->where('status',1);
                 }
                if ($request->status==2) {
                    $query->where('status',2);
                 }
                if ($request->status==3) {
                    $query->where('status',3);
                 }
                if ($request->status==4) {
                    $query->where('status',4);
                 }
                if ($request->status==5) {
                    $query->where('status',5);
                 }
                

            $order = $query->get();
            return DataTables::of($order)
                    ->addIndexColumn()
                    ->editColumn('status', function($row){
                        if($row->status == 0){
                            return ' <span class="badge badge-danger"> Pending </span> ';
                        }elseif($row->status == 1){
                            return ' <span class="badge badge-primary"> Recieved </span> ';
                        }elseif($row->status == 2){
                            return ' <span class="badge badge-info"> Shipped </span> ';
                        }elseif($row->status == 3){
                            return ' <span class="badge badge-success"> Completed </span> ';
                        }elseif($row->status == 4){
                            return ' <span class="badge badge-warning"> Return </span> ';
                        }else{
                            return ' <span class="badge badge-danger"> Cancel </span> ';
                        }
                    })
                    ->rawColumns(['status'])
                    ->make(true);
        }
        return view('admin.report.index');
    }

    public function orderPrint(Request $request){
        if($request->ajax()){
            $order = "";
            $query = DB::table('orders')->orderBy('id','DESC');
            if($request->payment_type){
                $query->where('payment_type',$request->payment_type);
            }
            if($request->date){
                $order_date = date('d-m-Y',strtotime($request->date));
                $query->where('date',$order_date);
            }
            if($request->status == 0){
                $query->where('status',0);
            }
            if($request->status == 1){
                $query->where('status',1);
            }
            if($request->status == 2){
                $query->where('status',2);
            }
            if($request->status == 3){
                $query->where('status',3);
            }
            if($request->status == 4){
                $query->where('status',4);
            }
            if($request->status == 5){
                $query->where('status',5);
            }

            $order = $query->get();
        }
        return view("admin.report.print",compact('order'));
    }
}
