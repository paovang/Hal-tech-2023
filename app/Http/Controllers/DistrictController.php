<?php

namespace App\Http\Controllers;

use App\Models\District;
use Illuminate\Http\Request;
use App\Http\Requests\DistrictRequest;


class DistrictController extends Controller
{

    public function listDistricts()
    {
        // $listDistricts = District::select(
        //     'districts.*',
        //     'pro.name as pro_name',
        // )
        // ->join(
        //     'provinces as pro',
        //     'pro.id', '=', 'districts.province_id'
        // )->orderBy('id', 'desc')
        // ->get();
        
        $listDistricts = District::orderBy('id', 'desc')->get();
        $listDistricts->map(function($item) {
            $item->province;
        });

        return $listDistricts;
    }

    public function addDistrict(DistrictRequest $request)
    {
        $addDistrict = new District();
        $addDistrict->name = $request['name'];
        $addDistrict->province_id = $request['province_id'];
        $addDistrict->save();

        return $addDistrict;
    }

    public function editDistrict(DistrictRequest $request, $id)
    {
        $editDistrict = District::find($id);
        $editDistrict->name = $request['name'];
        $editDistrict->province_id = $request['province_id'];
        $editDistrict->save();

        return $editDistrict;
    }

    public function deleteDistrict(DistrictRequest $request, $id)
    {
        $deleteDistrict = District::find($id);
        $deleteDistrict->delete();

        return $deleteDistrict;
    }
}
