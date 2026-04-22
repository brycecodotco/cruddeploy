<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookstore Manager</title>
    <link rel="stylesheet" href="{{ asset('css/bookstore.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <div class="container">
        <header class="main-header">
            <h1><i class="fa-solid fa-book-open"></i> Bookstore Inventory</h1>
        </header>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
                <button type="button" class="close-btn" onclick="this.parentElement.style.display='none';">&times;</button>
            </div>
        @elseif(session('delete'))
            <div class="alert alert-danger">
                {{ session('delete') }}
                <button type="button" class="close-btn" onclick="this.parentElement.style.display='none';">&times;</button>
            </div>
        @elseif(session('update'))
            <div class="alert alert-info">
                {{ session('update') }}
                <button type="button" class="close-btn" onclick="this.parentElement.style.display='none';">&times;</button>
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h2><i class="fa-solid fa-plus"></i> Add New Entry</h2>
            </div>
            <form action="/storebook" method="POST" class="product-form">
                @csrf
                <div class="form-grid">
                    <div class="form-group">
                        <label for="book_name">Book Title</label>
                        <input type="text" id="book_name" name="book_name" placeholder="The Great Gatsby" required>
                    </div>
                    <div class="form-group">
                        <label for="book_author">Author</label>
                        <input type="text" id="book_author" name="book_author" placeholder="F. Scott Fitzgerald"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="book_stock">Quantity in Stock</label>
                        <input type="number" id="book_stock" name="book_stock" placeholder="0" required min="0">
                    </div>
                    <div class="form-group">
                        <label for="book_date">Release Date</label>
                        <input type="date" id="book_date" name="book_date" required>
                    </div>
                </div>
                <button type="submit" class="btn-submit">
                    <i class="fa-solid fa-floppy-disk"></i> Save to Inventory
                </button>
            </form>
        </div>

        <div class="card mt-2">
            <div class="card-header flex-between">
                <h2><i class="fa-solid fa-list"></i> Current Collection</h2>
                <span class="badge">
                    {{ count($items) }} {{ count($items) == 1 ? 'Book' : 'Books' }}
                </span>
            </div>
            <div class="table-responsive">
                <table class="product-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Book Details</th>
                            <th>Stock</th>
                            <th>Published</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td><span class="text-muted">#{{ $item->id }}</span></td>
                                <td>
                                    <div class="book-info">
                                        <span class="book-title">{{ $item->book_name }}</span>
                                        <span class="book-author">{{ $item->book_author }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="stock-pill {{ $item->book_stock < 5 ? 'low' : '' }}">
                                        {{ $item->book_stock }}
                                    </span>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($item->book_date)->format('M d, Y') }}</td>
                                <td class="text-right">
                                    <div class="action-group">
                                        <a href="/books/{{ $item->id }}/edit" class="btn-edit" title="Edit">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <form action="/books/{{ $item->id }}" method="POST" class="inline-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-delete"
                                                onclick="return confirm('Remove this book from inventory?')" title="Delete">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>