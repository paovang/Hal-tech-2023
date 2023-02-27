<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;
use App\Http\Requests\ProvinceRequest;

class ProvinceController extends Controller
{
    
    public function listProvinces(Request $request)
    {
        // $listProvinces = Province::orderBy('id', 'desc')
        // ->where('name', 'LIKE', '%' . $request->search . '%')
        // ->get();
        $listProvinces = Province::search($request->search)->get();
        $listProvinces->map(function($item){
            $item->countDistrict = $item->district->count();
            $item->district;
        });

        return $listProvinces;
    }

    public function addProvince(ProvinceRequest $request)
    {
        $addProvince = new Province();
        $addProvince->name = $request['name'];
        $addProvince->save();

        return $addProvince;
    }

    public function editProvince(ProvinceRequest $request, $id)
    {
        $editProvince = Province::find($id);
        $editProvince->name = $request->name;
        $editProvince->save();

        return $editProvince;
    }

    public function deleteProvince(ProvinceRequest $request)
    {
        $deleteProvince = Province::find($request['id']);
        $deleteProvince->delete();

        return $deleteProvince;
    }
}
