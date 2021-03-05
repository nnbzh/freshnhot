<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Slider;
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
                $url = "/images/".$random.'.'.$extension;

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

    public function deleteImage(Request $request) {
        try {
            $validation = Validator::make($request->all(), [
                'img_src' => 'required'
            ]);

            if ($validation->fails()) {
                return response()->json(
                    [
                        "success"   => false,
                        "message"   => $validation->errors()
                    ]
                );
            }
            $src = $request->get('img_src');
            $slider = Slider::query()->where('img_src', $request->get('image_src'))->first();

            if ($slider != null) {
                $slider->delete();
            }

            return response()->json(
                [
                    'success'    => true,
                    'data'       => unlink(base_path()."/public$src")
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

    public function addSlider(Request $request) {
        try {
            $validation = Validator::make($request->all(), [
                'img_src' => 'required'
            ]);

            if ($validation->fails()) {
                return response()->json(
                    [
                        "success"   => false,
                        "message"   => $validation->errors()
                    ]
                );
            }

            return response()->json(
                [
                    'success'    => true,
                    'data'       => Slider::query()->updateOrCreate(['img_src' => $request->get('img_src')])
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

    public function getSliders() {
        try {
            return response()->json(
                [
                    'success'    => true,
                    'data'       => Slider::all()->toArray()
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
