<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book | Bookstore Manager</title>
    <link rel="stylesheet" href="{{ asset('css/bookstore.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <header class="main-header">
            <div class="flex-between">
                <h1><i class="fa-solid fa-pen-to-square"></i> Edit Book</h1>
                <a href="/books" class="btn-secondary">
                    <i class="fa-solid fa-arrow-left"></i> Back to Inventory
                </a>
            </div>
        </header>

        <div class="card">
            <div class="card-header">
                <h2>Modify Details for: <span class="text-primary">{{ $item->book_name }}</span></h2>
            </div>
            
            <form action="/books/{{ $item->id }}" method="POST" class="product-form">
                @csrf
                @method('PUT')
                
                <div class="form-grid">
                    <div class="form-group">
                        <label for="book_name">Book Title</label>
                        <input type="text" id="book_name" name="book_name" value="{{ old('book_name', $item->book_name) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="book_author">Author</label>
                        <input type="text" id="book_author" name="book_author" value="{{ old('book_author', $item->book_author) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="book_stock">Quantity in Stock</label>
                        <input type="number" id="book_stock" name="book_stock" value="{{ old('book_stock', $item->book_stock) }}" required min="0">
                    </div>

                    <div class="form-group">
                        <label for="book_date">Release Date</label>
                        <input type="date" id="book_date" name="book_date" value="{{ old('book_date', $item->book_date) }}" required>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-submit">
                        <i class="fa-solid fa-check"></i> Update Book Record
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>