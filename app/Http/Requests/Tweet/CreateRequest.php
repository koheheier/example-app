<?php

namespace App\Http\Requests\Tweet;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * リクエストを承認するかどうかを決定するメソッド
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        // keyが、リクエストbodyのkeyに対応。valueはLaravelのバリデーションルールで記述
        return [
            'tweet' => 'required|max:140'
        ];
    }
    
    // Requestクラスのuser関数で今自分がログインしているユーザーが取得できる
    public function userId(): int
    {
        return $this->user()// この段階で、userクラスを貰っており、そのidフィールドを取得しようとしている
        ->id;
    }

    // postされたツイートを取得する。
    public function tweet(): string
    {
        // 継承しているFormRequestが継承しているRequestのinputメソッドを使用。第一引数：postする値のname、第二引数：post値のnameが無い場合の初期値
        return $this->input('tweet');
    }


}
