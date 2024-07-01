<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function simpleSearchPage(Request $request)
    {
        $type = $request->input('type');
        $query = $request->input('query');

        // 検索可能なタイプ
        $validTypes = ['title', 'author', 'publication_date', 'genre'];
        if (!in_array($type, $validTypes)) {
            return response()->json(['error' => 'Invalid search type'], 400);
        }

        // 本の種類とリクエストから探す
        $books = Book::where($type, 'like', '%' . $query . '%')->get();

        // クライアントで便利に使えるようにデータを変換する
        $booksArray = $books->map(function ($book) {
            return [
                'book_id' => $book->book_id,
                'title' => $book->title,
                'author' => $book->author,
                'publication_date' => $book->publication_date,
                'genre' => $book->genre,
                'description' => $book->description,
                'cover_image' => $book->cover_image
            ];
        });

        // JSONレスポンスを返す
        return response()->json($booksArray);
    }

    public function detailSearchPage(Request $request)
    {
        $type1 = $request->input('type1');
        $query1 = $request->input('query1');
        $type2 = $request->input('type2');
        $query2 = $request->input('query2');
        $andOr = $request->input('andOr');

        $query = Book::query();

        if ($query1) {
            $query->where($type1, 'LIKE', '%' . $query1 . '%');
        }

        if ($query2) {
            if ($andOr === 'AND') {
                $query->where($type2, 'LIKE', '%' . $query2 . '%');
            } else {
                $query->orWhere($type2, 'LIKE', '%' . $query2 . '%');
            }
        }

        $results = $query->get();

        return response()->json($results);
    }


    public function showBook($id)
    {
        $book = Book::where('book_id', $id)->first();
        if (!$book) {
            abort(404, 'Book not found');
        }
        return view('books.book' . $id, compact('book'));
    }

    // 書籍の管理
    public function manageBooks()
    {
        $books = Book::paginate(10); // ページネーションが1ページあたり10であるすべての書籍を入手

        return view('bookManager.bookManagePage', compact('books'));
    }

    public function addBook(Request $request)
    {
        // クエリからbook_manager_idを取得
        $bookManagerId = $request->input('book_manager_id');

        // データの検証
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publication_date' => 'required|integer',
            'genre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // 画像のアップロード処理
        if ($request->hasFile('cover_image')) {
            $image = $request->file('cover_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $validatedData['cover_image'] = 'images/' . $imageName;
        }

        // book_manager_idをデータ配列に追加してブックを作成
        $validatedData['book_manager_id'] = $bookManagerId;

        // 新しい本の作成
        $book = Book::create($validatedData);

        if ($book) {
            // 本の作成に成功しました
            return redirect()->route('books.manage')->with('成功', '本の追加に成功');
        } else {
            // ブック作成中にエラーが発生しました
            return back()->withInput()->withErrors(['エラー' => '本の追加に失敗']);
        }
    }

    public function editBookSubmit(Request $request, $book_id)
    {
        $book = Book::findOrFail($book_id);

        // データの検証
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publication_date' => 'required|integer',
            'genre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // 画像のアップロード処理
        if ($request->hasFile('cover_image')) {
            $image = $request->file('cover_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $validatedData['cover_image'] = 'images/' . $imageName;
        }

        // 書籍のデータを更新
        $book->update($validatedData);

        return redirect()->route('books.manage')->with('成功', '本が正常に更新成功');
    }


    public function deleteBook($book_id)
    {
        $book = Book::findOrFail($book_id);
        $book->delete();

        return redirect()->route('books.manage')->with('成功', '本は正常に削除成功');
    }


    public function showBook1()
    {
        return $this->showBook(1);
    }

    public function showBook2()
    {
        return $this->showBook(2);
    }

    public function showBook3()
    {
        return $this->showBook(3);
    }

    public function showBook4()
    {
        return $this->showBook(4);
    }

    public function showBook5()
    {
        return $this->showBook(5);
    }

    public function showBook6()
    {
        return $this->showBook(6);
    }

    public function showBook7()
    {
        return $this->showBook(7);
    }

    public function showBook8()
    {
        return $this->showBook(8);
    }

    public function showBook9()
    {
        return $this->showBook(9);
    }

    public function showBook10()
    {
        return $this->showBook(10);
    }

    public function showBook11()
    {
        return $this->showBook(11);
    }

    public function showBook12()
    {
        return $this->showBook(12);
    }

    public function showBook13()
    {
        return $this->showBook(13);
    }

    public function showBook14()
    {
        return $this->showBook(14);
    }

    public function showBook15()
    {
        return $this->showBook(15);
    }

    public function showBook16()
    {
        return $this->showBook(16);
    }

    public function showBook17()
    {
        return $this->showBook(17);
    }

    public function showBook18()
    {
        return $this->showBook(18);
    }

    public function showBook19()
    {
        return $this->showBook(19);
    }

    public function showBook20()
    {
        return $this->showBook(20);
    }

    public function showBook21()
    {
        return $this->showBook(21);
    }

    public function showBook22()
    {
        return $this->showBook(22);
    }

    public function showBook23()
    {
        return $this->showBook(23);
    }

    public function showBook24()
    {
        return $this->showBook(24);
    }

    public function showBook25()
    {
        return $this->showBook(25);
    }

    public function showBook26()
    {
        return $this->showBook(26);
    }

    public function showBook27()
    {
        return $this->showBook(27);
    }

    public function showBook28()
    {
        return $this->showBook(28);
    }

    public function showBook29()
    {
        return $this->showBook(29);
    }

    public function showBook30()
    {
        return $this->showBook(30);
    }

    public function showBook31()
    {
        return $this->showBook(31);
    }

    public function showBook32()
    {
        return $this->showBook(32);
    }

    public function showBook33()
    {
        return $this->showBook(33);
    }

    public function showBook34()
    {
        return $this->showBook(34);
    }

    public function showBook35()
    {
        return $this->showBook(35);
    }

    public function showBook36()
    {
        return $this->showBook(36);
    }

    public function showBook37()
    {
        return $this->showBook(37);
    }

    public function showBook38()
    {
        return $this->showBook(38);
    }

    public function showBook39()
    {
        return $this->showBook(39);
    }

    public function showBook40()
    {
        return $this->showBook(40);
    }

    public function showBook41()
    {
        return $this->showBook(41);
    }

    public function showBook42()
    {
        return $this->showBook(42);
    }

    public function showBook43()
    {
        return $this->showBook(43);
    }

    public function showBook44()
    {
        return $this->showBook(44);
    }

    public function showBook45()
    {
        return $this->showBook(45);
    }

    public function showBook46()
    {
        return $this->showBook(46);
    }

    public function showBook47()
    {
        return $this->showBook(47);
    }

    public function showBook48()
    {
        return $this->showBook(48);
    }

    public function showBook49()
    {
        return $this->showBook(49);
    }

    public function showBook50()
    {
        return $this->showBook(50);
    }
}
