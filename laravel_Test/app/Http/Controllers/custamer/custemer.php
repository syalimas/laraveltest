<?php

namespace App\Http\Controllers\custamer;
use  App\customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class custemer extends Controller
{

     
        public function  licenceAdd (Request $request ){
         $cust = new customer();
        $input = $request->all();
        $id = '';
//var_dump($input); return;
               $officetype= $input['officetype'];
                $licno= $input['licno'];
                $licdt= $input['licdt'];
                $licname= $input['licname'];
                $licadr= $input['licadr'];
                $lictype= $input['lictype'];
  
        if(isset($input['dats'])){
          $id= $input['id'];
        }
        if($id == ''){
          $qry = " INSERT INTO licence (office_type,lic_no,lic_date,lic_name,lic_address,lic_type)values (?,?,?,?,?,?)";
          DB::insert($qry,[ $officetype,  $licno, $licdt,  $licname,$licadr, $lictype]);
        }
        else{
          $qry = " UPDATE licence set office_type =$officetype ,lic_no =  $licno ,lic_date = '$licdt' ,lic_name = $licname,
            lic_address =$licadr , lic_type = $lictype   WHERE lic_id =$id";
            DB::update($qry);
          $cust = customer::find($id);
        }
     //    $cust->office_type = $officetype;
     //    $cust->lic_no = $licno;,
     //    $cust->lic_date = $licdt;
     //    $cust->lic_name = $licname;
     //    $cust->lic_address = $licadr;
     //    $cust->lic_type = $lictype;
     //    $cust->save();
        

   }
   public function  getlicenceall (Request $request ){
     $cust = new customer();    
    return $cust::orderBy('lic_name')->get();

   }

   public function  licencegetID (Request $request ){
     $cust = new customer();    
     $input = $request->all();
        $id =  $input['id'];
    return $cust::orderBy('lic_name')->find($id);
    }

    public function  deleteLicence (Request $request ){
     $cust = new customer();    
     $input = $request->all();
        $id =  $input['id'];
     $cust::find($id)->delete();
    }
    



}
