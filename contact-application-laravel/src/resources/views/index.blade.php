<!-- resources/views/index.blade.php -->
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

<!-- axiosのCDN読み込み -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

@section('content')
<div class="admin_container">
    <div class="section__title">
        <h2>Admin</h2>
    </div>
    <form id="searchForm" action="{{ route('admin.search') }}" method="get">
        <input class="search-form__item-input" type="text" name="keyword" value="" placeholder="名前やメールアドレスを入力してください">
        <select name="gender">
            <option value="" selected disabled>性別</option>
            <option value="1">男性</option>
            <option value="2">女性</option>
            <option value="3">その他</option>
        </select>
        <select name="category" id="">
            <option value="" selected disabled>お問い合わせの種類</option>
            @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->content }}</option>
            @endforeach
        </select>
        <input type="date" name="date" class="admin-date">
        <button type="submit" class="admin-search">検索</button>
        <button type="button" class="admin-reset" onclick="resetForm()">リセット</button>
    </form>

    <div class="pagination-container">
        <div>
            <button type="" class="admin-export">エクスポート</button>
        </div>
        <div class="pagination-links">
            <!-- ページネーションリンク -->
            {{ $contacts->links() }}
        </div>
    </div>

    <!-- テーブル -->
    <div class="admin-table">
        <table class="admin-table__inner">
            <thead>
                <tr>
                    <th colspan="2">お名前</th>
                    <th>性別</th>
                    <th>メールアドレス</th>
                    <th colspan="2">お問い合わせの種類</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contacts as $contact)
                <tr>
                    <td class="admin-table__first_name">{{ $contact->first_name }}</td>
                    <td>{{ $contact->last_name }}</td>
                    <td>
                        @if($contact->gender === 1)
                        男性
                        @elseif($contact->gender === 2)
                        女性
                        @elseif($contact->gender === 3)
                        その他
                        @endif
                    </td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->category->content }}</td>
                    <td><button class="admin-detail" data-contact="{{ json_encode($contact) }}">詳細</button></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- モーダルのHTML -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div id="modalContent">
                <!-- テーブルがここに表示されます -->
                <table class="modal-table">
                    <tbody id="modalTableBody">
                        <tr>
                            <td>名前</td>
                            <td id="modalFirstName"></td>
                        </tr>
                        <tr>
                            <td>性別</td>
                            <td id="modalGender"></td>
                        </tr>
                        <tr>
                            <td>メールアドレス</td>
                            <td id="modalEmail"></td>
                        </tr>
                        <tr>
                            <td>電話番号</td>
                            <td id="modalTell"></td>
                        </tr>
                        <tr>
                            <td>住所</td>
                            <td id="modalAddres"></td>
                        </tr>
                        <tr>
                            <td>建物名</td>
                            <td id="modalBuilding"></td>
                        </tr>
                        <tr>
                            <td>お問い合わせの種類</td>
                            <td id="modalCategoryContent"></td>
                        </tr>
                        <tr>
                            <td>お問い合わせ内容</td>
                            <td id="modalDetail"></td>
                        </tr>
                    </tbody>
                </table>
                <!-- 削除ボタンの行 -->
                <div class="modal-delete">
                    <button id="deleteButton">削除</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function resetForm() {
        document.getElementById("searchForm").reset();
    }

    // 詳細ボタンがクリックされたときの処理
    document.querySelectorAll('.admin-detail').forEach(button => {
        button.addEventListener('click', function() {
            // モーダルに表示する内容を取得
            const contactData = JSON.parse(this.dataset.contact);
            const modalTableBody = document.getElementById('modalTableBody');

            // テーブルの内容をリセット
            modalTableBody.innerHTML = '';

            // テーブルの行を追加
            modalTableBody.innerHTML += `
                <tr>
                    <td>お名前</td>
                    <td>${contactData.first_name} ${contactData.last_name}</td>
                </tr>
                <tr>
                    <td>性別</td>
                    <td>${contactData.gender === 1 ? '男性' : (contactData.gender === 2 ? '女性' : 'その他')}</td>
                </tr>
                <tr>
                    <td>メールアドレス</td>
                    <td>${contactData.email}</td>
                </tr>
                <tr>
                    <td>電話番号</td>
                    <td>${contactData.tell}</td>
                </tr>
                <tr>
                    <td>住所</td>
                    <td>${contactData.address}</td>
                </tr>
                <tr>
                    <td>建物名</td>
                    <td>${contactData.building}</td>
                </tr>
                <tr>
                    <td>お問い合わせの種類</td>
                    <td>${contactData.category.content}</td>
                </tr>
                <tr>
                    <td>お問い合わせ内容</td>
                    <td>${contactData.detail}</td>
                </tr>
            `;

            // 削除ボタンのリスナーを追加
            const deleteButton = document.getElementById('deleteButton');
            deleteButton.addEventListener('click', handleDelete);

            // モーダルを表示
            document.getElementById('myModal').style.display = 'block';
        });
    });

    // モーダルを閉じる処理
    document.querySelector('.close').addEventListener('click', function() {
        document.getElementById('myModal').style.display = 'none';
    });

    // 削除ボタンのリスナーを追加
    function handleDelete() {
        // ここでデータベースから削除処理を行う
        const contactData = JSON.parse(document.querySelector('.admin-detail').dataset.contact);
        const contactId = contactData.id;
        axios.delete(`/contacts/${contactId}`)
            .then(response => {
                console.log(response.data.message);
                // 削除処理が成功したらモーダルを閉じる
                document.getElementById('myModal').style.display = 'none';
            })
            .catch(error => {
                console.error('エラー:', error);
            });
    }
</script>
@endsection