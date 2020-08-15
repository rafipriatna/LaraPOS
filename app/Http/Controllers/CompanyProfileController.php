<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\CompanyProfile;

use App\Http\Requests\CompanyProfileRequest;

class CompanyProfileController extends Controller
{
    public function index(){
        $title = "Company Profile";

        return view('pages.companyProfile.index', [
            'title' => $title
        ]);
    }

    public function save(AboutRequest $request){
        $data = $request->all();

        $currentProfile = About::findOrFail(1);

        if (!$currentProfile){
            About::create($data);
            return redirect()->route('companyProfile.index')->with('success','Profil toko berhasil disimpan!');
        }else{
            $currentProfile->update($data);
            return redirect()->route('companyProfile.index')->with('success','Profil toko berhasil disimpan!');
        }
    }
}
