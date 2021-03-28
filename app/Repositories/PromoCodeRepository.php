<?php


namespace App\Repositories;


use App\Models\PromoCode;

class PromoCodeRepository
{
    public function generatePromoCode()
    {
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
        $promo = substr(str_shuffle($permitted_chars), 0, 6);

        if (PromoCode::query()->where('code', 'like', "%$promo%")->doesntExist()) {
            return PromoCode::query()->updateOrCreate(['code' => $promo]);
        }

        return $this->generatePromoCode();
    }

    public function getAllPromoCodes()
    {
        return PromoCode::all()->toArray();
    }

    public function createPromoCode($data)
    {
        $promo = new PromoCode();
        $promo->code = $data['code'];
        $promo->value = $data['value'];
        $promo->saveOrFail();
        return $promo;
    }

    public function getPromoCode($code)
    {
        return PromoCode::query()->where('code', 'like', "$code")->firstOrFail()->toArray();
    }

    public function deletePromoCode($id)
    {
        $promo = PromoCode::query()->findOrFail($id);
        return $promo->delete();
    }
}
