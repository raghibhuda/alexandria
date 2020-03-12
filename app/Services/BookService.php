<?php


namespace App\Services\Admin;


use App\Book;
use App\BookInfo;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BookService
{
    /**
     * @param int $id
     * @return Book|Book[]|Builder|Builder[]|Collection|Model|null
     */
    public function findOne(int $id): array {
        $book = Book::with('bookInfo')->find($id);
        if (!$book) {
            return ['success' => false, 'message' => 'Book not found'];
        }
        return [
            'success' => true,
            'message' => 'Book has benn fetched',
            'book' => $book,
        ];

    }

    /**
     * @return Book[]|Builder[]|Collection
     */
    public function findAll(): array {
        $books = Book::with('bookInfo')->get();
        return [
            'success' => true,
            'message' => 'Author has benn fetched',
            'books' => $books,
        ];

    }

    /**
     * @param string $name
     * @param int $categoryId
     * @param int $authorId
     * @param int $publicationId
     * @param array $data
     * @return array
     */
    public function create(string $name, int $categoryId, int $authorId, int $publicationId, array $data): array {
        try {
            DB::beginTransaction();
            $book = $this->createBook($name, $categoryId, $authorId, $publicationId);
            if (!$book['success']) {
                DB::rollBack();
                return ['success' => false, 'message' => __('Something went wrong')];
            }
            $bookInfo = $this->createBookInfo($book['bookId'], $data);
            if (!$bookInfo['success']) {
                DB::rollBack();
                return ['success' => false, 'message' => __('Something went wrong')];
            }
            DB::commit();
            return ['success' => true, 'message' => __('Book has been created')];
        } catch (Exception $e) {
            DB::rollBack();
            return ['success' => false, 'message' => __('Failed to creat book')];
        }
    }

    /**
     * @param string $name
     * @param int $categoryId
     * @param int $authorId
     * @param int $publicationId
     * @return array
     */
    private function createBook(string $name, int $categoryId, int $authorId, int $publicationId) {
        try {
            $book = Book::create([
                'name' => $name,
                'category_id' => $categoryId,
                'author_id' => $authorId,
                'publication_id' => $publicationId
            ]);

            return ['success' => true, 'bookId' => $book->id, 'message' => __('Only book has been created')];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => __('Failed to create only book')
            ];
        }
    }

    /**
     * @param int $bookId
     * @param array $data
     * @return array
     */
    private function createBookInfo(int $bookId, array $data) {
        try {
            BookInfo::create([
                'book_id' => $bookId,
                'price' => $data['price'],
                'quantity' => $data['quantity'],
                'in_stock' => $data['inStock'],
                'language' => $data['language'],
                'published_on' => $data['publishedOn'],
                'total_pages' => $data['totalPages'],
                'isbn_number' => $data['isbnNumber'],
                'characters' => $data['characters'],
                'series_name' => $data['seriesName'],
                'description' => $data['description'],
            ]);
            return [
                'success' => true,
                'message' => __('Book Info has been created')
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => 'Failed to create Book Info'
            ];
        }
    }


    /**
     * @param int $bookId
     * @param string $name
     * @param int $categoryId
     * @param int $authorId
     * @param int $publicationId
     * @param array $data
     * @return array
     */
    public function update(int $bookId, string $name, int $categoryId, int $authorId, int $publicationId, array $data): array {
        try {
            DB::beginTransaction();
            $book = $this->updateBook($bookId, $name, $categoryId, $authorId, $publicationId);
            if (!$book['success']) {
                DB::rollBack();
                return ['success' => false, 'message' => __('Something went wrong')];
            }
            $booInfo = $this->updateBookInfo($bookId, $data);
            if (!$booInfo['success']) {
                DB::rollBack();
                return ['success' => false, 'message' => __('Something went wrong')];
            }
            DB::commit();
            return ['success' => true, 'message' => 'Book has been updated'];
        } catch (Exception $e) {
            DB::rollBack();
            return ['success' => false, 'message' => 'Failed to update book'];
        }
    }

    /**
     * @param int $bookId
     * @param string $name
     * @param int $categoryId
     * @param int $authorId
     * @param int $publicationId
     * @return array
     */
    private function updateBook(int $bookId, string $name, int $categoryId, int $authorId, int $publicationId): array {
        try {
            $book = Book::where('id', $bookId)->update([
                'name' => $name,
                'category_id' => $categoryId,
                'author_id' => $authorId,
                'publication_id' => $publicationId
            ]);
            if (!$book) {
                return ['success' => false, 'message' => __('Book not found')];
            }
            return ['success' => true, 'message' => __('Only book has been updated')];
        } catch (Exception $e) {
            return ['success' => false, 'message' => __('Failed to create only book')];
        }
    }

    /**
     * @param int $bookId
     * @param array $data
     * @return array
     */
    private function updateBookInfo(int $bookId, array $data): array {
        try {
            $bookInfo = BookInfo::where('book_id', $bookId)->update([
                'price' => $data['price'],
                'quantity' => $data['quantity'],
                'in_stock' => $data['inStock'],
                'language' => $data['language'],
                'published_on' => $data['publishedOn'],
                'total_pages' => $data['totalPages'],
                'isbn_number' => $data['isbnNumber'],
                'characters' => $data['characters'],
                'series_name' => $data['seriesName'],
                'description' => $data['description'],
            ]);
            if (!$bookInfo) {
                return ['success' => false, 'message' => __('Book Info not found')];
            }
            return [
                'success' => true,
                'message' => __('Book Info has been updated')
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => 'Failed to update Book Info'
            ];
        }
    }

    /**
     * @param int $bookId
     * @return array
     */
    public function delete(int $bookId): array {
        try {
            $book = Book::find($bookId)->delete();
            if (!$book) {
                return ['success' => false, 'message' => __('Book not found')];
            }
            return ['success' => true, 'message' => __('Book has been deleted')];
        } catch (Exception $e) {
            return ['success' => false, 'message' => __('Failed to delete book')];
        }
    }

}
