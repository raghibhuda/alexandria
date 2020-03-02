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
     * @param int $book_id
     * @param float $price
     * @param int $quantity
     * @param int $in_stock
     * @param int $total_pages
     * @param string $isbn_number
     * @param string $language
     * @param string $characters
     * @param string $series_name
     * @param string $description
     * @param string $published_on
     * @return array
     */
    public function create (string $name , int $category_id , int $author_id , int $publication_id , float $price,int $quantity,int $in_stock , int $total_pages , string $isbn_number , string $language ,string $characters, string $series_name , string $description , string $published_on) :array {
        try {
            DB::beginTransaction();
            $book  = Book::create([
                'name' => $name,
                'category_id' => $category_id,
                'author_id' => $author_id,
                'publication_id' => $publication_id
            ]);

            if (!$book) {
                return ['success' => false, 'message' => 'Something went wrong'];
            }else{
                BookInfo::create([
                    'book_id' => $book->id,
                    'price'=> $price,
                    'quantity' => $quantity,
                    'in_stock'=> $in_stock,
                    'language' => $language,
                    'published_on' => $published_on,
                    'total_pages' => $total_pages,
                    'isbn_number' => $isbn_number,
                    'characters' => $characters,
                    'series_name' => $series_name,
                    'description' => $description,
                ]);
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
     * @param string $name
     * @param int $category_id
     * @param int $author_id
     * @param int $publication_id
     * @param int $book_id
     * @param float $price
     * @param int $quantity
     * @param int $in_stock
     * @param int $total_pages
     * @param string $isbn_number
     * @param string $language
     * @param string $characters
     * @param string $series_name
     * @param string $description
     * @param string $published_on
     * @return array
     */
    public function update(string $name , int $category_id , int $author_id , int $publication_id , int $book_id , float $price,int $quantity,int $in_stock , int $total_pages , string $isbn_number , string $language ,string $characters, string $series_name , string $description , string $published_on) :array {
        try {
            DB::beginTransaction();
            $book  = Book::where('id',$book_id)->update([
                'name' => $name,
                'category_id' => $category_id,
                'publication_id' => $publication_id,
                'author_id' => $author_id,
            ]);
            $bookInfo = BookInfo::where('book_id',$book_id)->update([
                'book_id' => $book_id,
                'price'=> $price,
                'quantity' => $quantity,
                'in_stock'=> $in_stock,
                'language' => $language,
                'published_on' => $published_on,
                'total_pages' => $total_pages,
                'isbn_number' => $isbn_number,
                'characters' => $characters,
                'series_name' => $series_name,
                'description' => $description,
            ]);
            if(!$book || !$bookInfo) {
                return ['success' => false, 'message' => 'Book not found'];
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
