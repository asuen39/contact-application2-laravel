<?php

namespace App\Http\Controllers;

use App\Models\Contacts;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class InquiryController extends Controller
{
    public function inquiry()
    {
        $categories = Category::all();
        $previousInput = session()->get('contact'); //直前までの入力内容をセット
        return view('inquiry', ['categories' => $categories, 'previousInput' => $previousInput]);
    }

    public function confirm(Request $request)
    {
        // バリデーションルールを定義
        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'email' => 'required|email',
            'tell1' => 'required|numeric|min:0',
            'tell2' => 'required|numeric|min:0',
            'tell3' => 'required|numeric|min:0',
            'address' => 'required',
            'building' => 'nullable',
            'category_id' => 'required',
            'detail' => 'required|max:120',
        ];

        // バリデーションメッセージの定義
        $messages = [
            'first_name.required' => '姓を入力してください',
            'last_name.required' => '名を入力してください',
            'gender.required' => '性別を選択してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレス形式で入力してください。',
            'tell1.required' => '電話番号の最初の部分を入力してください。',
            'tell2.required' => '電話番号の中央の部分を入力してください。',
            'tell3.required' => '電話番号の最後の部分を入力してください。',
            'tell1.numeric' => '電話番号の最初の部分は数字で入力してください。',
            'tell2.numeric' => '電話番号の中央の部分は数字で入力してください。',
            'tell3.numeric' => '電話番号の最後の部分は数字で入力してください。',
            'tell1.min' => '電話番号の最初の部分は0以上の数値で入力してください。',
            'tell2.min' => '電話番号の中央の部分は0以上の数値で入力してください。',
            'tell3.min' => '電話番号の最後の部分は0以上の数値で入力してください。',
            'address.required' => '住所を入力してください',
            'category_id.required' => 'お問い合わせの種類を選択してください',
            'detail.required' => 'お問い合わせ内容を入力してください',
            'detail.max' => 'お問合せ内容は120文字以内で入力してください',
        ];

        // バリデーション実行
        $validator = Validator::make($request->all(), $rules, $messages);

        // バリデーションエラーがある場合は入力フォームにリダイレクト
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // 電話番号を結合して整形
        $tell = $request->input('tell1') . $request->input('tell2') . $request->input('tell3');

        $contact = $request->only(['first_name', 'last_name', 'gender', 'email', 'address', 'building', 'category_id', 'detail', 'tell1', 'tell2', 'tell3']);

        // カテゴリー取得
        $categories = Category::all();

        // 入力内容をセッションに保存
        Session::put('contact', $contact);

        return view('confirm', compact('contact', 'tell', 'categories')); // $categoriesをビューに渡す
    }

    public function store(Request $request)
    {
        // 送信されたデータをログに出力
        Log::info($request->all());

        // フォームから送信されたデータを取得
        $contactData = $request->only(['first_name', 'last_name', 'gender', 'email', 'tell', 'address', 'building', 'detail']);

        // 性別の値をマッピング
        $gender = $this->mapGender($request->input('gender'));

        // 電話番号の整形
        $phoneNumber = $request->input('tell1') . '-' . $request->input('tell2') . '-' . $request->input('tell3');

        // カテゴリーIDを取得
        $categoryId = $request->input('category_id');

        // データベースに保存
        Contacts::create(array_merge($contactData, [
            'gender' => $gender,
            'tell' => $phoneNumber,
            'category_id' => $categoryId,
        ]));

        // 保存完了後のページにリダイレクト
        return redirect('/thanks');
    }

    // 性別をマッピングするメソッド
    private function mapGender($gender)
    {
        switch ($gender) {
            case '男性':
                return 1;
            case '女性':
                return 2;
            default:
                return 3; // その他の場合はデフォルトの値を返す
        }
    }
}
