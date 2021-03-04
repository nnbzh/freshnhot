<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\SliderImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ImageController extends Controller
{
    public function uploadImage(Request $request) {
        try {
            $validation = Validator::make($request->all(), [
                "image" => 'required|image|max:10000|mimes:jpeg,png,jpg,gif,svg'
            ]);

            if ($validation->fails()) {
                return response()->json(
                    [
                        "success"   => false,
                        "message"   => $validation->errors()
                    ]
                );
            }
            $random = Str::random(8);
            $extension = null;
            if ($request->hasFile('image')) {
                $extension = $request->file('image')->extension();
                $image = $request->file('image');
                $image_name = $random.'.'.$request->file('image')->extension();
                $destinationPath = base_path().'/public/images';
                $image->move($destinationPath, $image_name);

                return response()->json(
                    [
                        "success"   => true,
                        "data"      => "/images/".$random.'.'.$extension
                    ]
                );
            } else {
                return response()->json(
                    [
                        "success"   => false,
                        "data"      => "Файл был загружен не правильно"
                    ], 400, JSON_UNESCAPED_UNICODE
                );
            }

        } catch (\Exception $exception) {
            return response()->json(
                [
                    "success"   => false,
                    "message"   => $exception->getMessage()
                ], 500
            );
        }
    }

    public function uploadSlider(Request $request) {
        try {
            $validation = Validator::make($request->all(), [
                "image" => 'required|image|max:10000|mimes:jpeg,png,jpg,gif,svg'
            ]);

            if ($validation->fails()) {
                return response()->json(
                    [
                        "success"   => false,
                        "message"   => $validation->errors()
                    ]
                );
            }
            $random = Str::random(8);
            $extension = null;
            if ($request->hasFile('image')) {
                $extension = $request->file('image')->extension();
                $image = $request->file('image');
                $image_name = $random.'.'.$request->file('image')->extension();
                $destinationPath = base_path().'/public/images/slider';
                $image->move($destinationPath, $image_name);
                $url = "/images/slider".$random.'.'.$extension;
                SliderImage::query()->create(['url' => $url]);
                return response()->json(
                    [
                        "success"   => true,
                        "data"      => $url
                    ]
                );
            } else {
                return response()->json(
                    [
                        "success"   => false,
                        "data"      => "Файл был загружен не правильно"
                    ], 400, JSON_UNESCAPED_UNICODE
                );
            }

        } catch (\Exception $exception) {
            return response()->json(
                [
                    "success"   => false,
                    "message"   => $exception->getMessage()
                ], 500
            );
        }
    }

    public function getAllSliders(Request $request) {
        try {
           return response()->json(
               [
                   'success'    => true,
                   'data'       => SliderImage::all()->toArray()
               ]
           );

        } catch (\Exception $exception) {
            return response()->json(
                [
                    "success"   => false,
                    "message"   => $exception->getMessage()
                ], 500
            );
        }
    }

    public function deleteSlider($id) {
        try {
            return response()->json(
                [
                    'success'    => true,
                    'data'       => SliderImage::query()->where('id', $id)->delete()
                ]
            );

        } catch (\Exception $exception) {
            return response()->json(
                [
                    "success"   => false,
                    "message"   => $exception->getMessage()
                ], 500
            );
        }
    }
}
