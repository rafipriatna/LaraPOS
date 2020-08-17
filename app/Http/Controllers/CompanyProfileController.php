<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\CompanyProfile;

use App\Http\Requests\CompanyProfileRequest;

class CompanyProfileController extends Controller
{
    public function index(){
        $title = "Company Profile";

        $item = CompanyProfile::find(1);

        return view('pages.companyProfile.index', [
            'title' => $title,
            'item' => $item
        ]);
    }

    public function save(CompanyProfileRequest $request){
        $data = $request->all();
        $image = $request->file('image');

        if ($image){
            $data['image'] = $image->storeAs(
                'public/assets/company', 'company.jpg'
            );
        }else{
            $data['image'] = "";
        }

        $currentProfile = CompanyProfile::find(1);

        if (!$currentProfile){
            CompanyProfile::create($data);
            return redirect()->route('companyProfile.index')->with('success','Profil toko berhasil disimpan!');
        }else{
            $currentProfile->update($data);
            return redirect()->route('companyProfile.index')->with('success','Profil toko berhasil disimpan!');
        }
    }
}
