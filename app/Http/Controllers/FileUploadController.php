<?php

namespace App\Http\Controllers;

use App\Country;
use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function convert() {
        $countryData = Country::get();
        foreach ($countryData as $key => $value) {  
            $fileName = $value->code.".jpeg";
            $path = public_path().'/uploads/' . $fileName;
            \Image::make(file_get_contents($value->flag_url))->save($path);     
            Country::whereId($value->id)->update(array('flag_url' => $path));
        }
    }
}
