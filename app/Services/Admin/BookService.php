<?php


namespace App\Services\Admin;


use App\Book;
use App\BookInfo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Exception;

class BookService
{
    /**
     * @param string $name
     * @param int $category_id
     * @param int $author_id
     * @param int $publication_id
     * @param array $data
     * @return array
     */
    public function create (string $name , int $category_id , int $author_id , int $publication_id , array $data) :array {
        try {
            DB::beginTransaction();
            $book = $this->createBook($name, $category_id, $author_id, $publication_id);
            if (!$book['success']) {
                DB::rollBack();
                return ['success' => false, 'message' => 'Something went wrong'];
            }
            $bookInfo = $this->createBookInfo($book['book_id'],$data);
            if (!$bookInfo['success']) {
                DB::rollBack();
                return ['success' => false, 'message' => 'Something went wrong'];
            }
            DB::commit();
            return [
                'success' => true,
                'message' => 'Book has been created'
            ];
        } catch (Exception $e) {
            DB::rollBack();
            return [
                'success' => false,
                'message' => 'Failed to creat book'
            ];
        }
    }

    /**
     * @param string $name
     * @param int $category_id
     * @param int $author_id
     * @param int $publication_id
     * @return array
     */
    private function createBook (string $name , int $category_id , int $author_id , int $publication_id) {
        try {
            $book  = Book::create([
                'name' => $name,
                'category_id' => $category_id,
                'author_id' => $author_id,
                'publication_id' => $publication_id
            ]);

            return [
                'success' => true,
                'book_id' => $book->id,
                'message' => 'Only book has been created'
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => 'Failed to create only book'
            ];
        }
    }

    /**
     * @param int $book_id
     * @param array $data
     * @return array
     */
    private function createBookInfo (int $book_id , array $data) {
        try {
            BookInfo::create([
                'book_id' => $book_id,
                'price'=> $data['price'],
                'quantity' => $data['quantity'],
                'in_stock'=> $data['in_stock'],
                'language' => $data['language'],
                'published_on' => $data['published_on'],
                'total_pages' => $data['total_pages'],
                'isbn_number' => $data['isbn_number'],
                'characters' => $data['characters'],
                'series_name' => $data['series_name'],
                'description' => $data['description'],
            ]);
            return [
                'success' => true,
                'message' => 'Book Info has been created'
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => 'Failed to create Book Info'
            ];
        }
    }
    /**
     * @param int $id
     * @return Book|Book[]|Builder|Builder[]|Collection|Model|null
     */
    public function find (int $id) {
        return Book::with('bookInfo')->find($id);
    }

    /**
     * @return Book[]|Builder[]|Collection
     */
    public function books () {
        return Book::with('bookInfo')->get();
    }

    /**
     * @param int $book_id
     * @param string $name
     * @param int $category_id
     * @param int $author_id
     * @param int $publication_id
     * @param array $data
     * @return array
     */
    public function update(int $book_id,string $name , int $category_id , int $author_id , int $publication_id,array $data) :array {
        try {
            DB::beginTransaction();
            $book = $this->updateBook($book_id,$name,$category_id,$author_id,$publication_id);
            if (!$book['success']) {
                DB::rollBack();
                return ['success' => false, 'message' => 'Something went wrong'];
            }
            $booInfo = $this->updateBookInfo($book_id,$data);
            if (!$booInfo['success']) {
                DB::rollBack();
                return ['success' => false, 'message' => 'Something went wrong'];
            }
            DB::commit();
            return [
                'success' => true,
                'message' => 'Book has been updated'
            ];
        }  catch (Exception $e) {
            DB::rollBack();
            return [
                'success' => false,
                'message' => 'Failed to update book'
            ];
        }
    }

    /**
     * @param int $book_id
     * @param string $name
     * @param int $category_id
     * @param int $author_id
     * @param int $publication_id
     * @return array
     */
    private function updateBook (int $book_id,string $name , int $category_id , int $author_id , int $publication_id) : array {
        try {
            Book::where('id',$book_id)->update([
                'name' => $name,
                'category_id' => $category_id,
                'author_id' => $author_id,
                'publication_id' => $publication_id
            ]);
            return [
                'success' => true,
                'message' => 'Only book has been created'
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => 'Failed to create only book'
            ];
        }
    }

    /**
     * @param int $book_id
     * @param array $data
     * @return array
     */
    private function updateBookInfo (int $book_id , array $data) :array {
        try {
                BookInfo::where('book_id',$book_id)->update([
                'price'=> $data['price'],
                'quantity' => $data['quantity'],
                'in_stock'=> $data['in_stock'],
                'language' => $data['language'],
                'published_on' => $data['published_on'],
                'total_pages' => $data['total_pages'],
                'isbn_number' => $data['isbn_number'],
                'characters' => $data['characters'],
                'series_name' => $data['series_name'],
                'description' => $data['description'],
            ]);
            return [
                'success' => true,
                'message' => 'Book Info has been updated'
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => 'Failed to update Book Info'
            ];
        }
    }

    /**
     * @param int $book_id
     * @return array
     */
    public function delete (int $book_id) :array {
        try {
            $book = Book::find($book_id)->delete();
            if(!$book) {
                return [
                    'success' => false,
                    'message' => 'Book not found'
                ];
            }
            return [
                'success' => true,
                'message' => 'Book has been deleted'
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => 'Failed to delete book'
            ];
        }
    }

}
