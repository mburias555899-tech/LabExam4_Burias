<h2>Rice Menu</h2>

<a href="{{ route('dashboard') }}">
    <button type="button">⬅ Back to Dashboard</button>
</a>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<hr>


<form action="{{ isset($menu) ? route('menu.update', $menu->id) : route('menu.store') }}" method="POST">
    @csrf

    @if(isset($menu))
        @method('PUT')
    @endif

    <div style="display:flex; gap:10px; align-items:center; flex-wrap:wrap;">

        <input type="text" name="name" placeholder="Rice Name"
            value="{{ $menu->name ?? '' }}" required>

        <input type="text" name="category" placeholder="Category"
            value="{{ $menu->category ?? '' }}" required>

        <div style="display:flex; align-items:center; gap:5px;">
            <input type="number" step="0.01" name="price_per_kilo"
                placeholder="Price"
                value="{{ $menu->price_per_kilo ?? '' }}"
                required>
            <span>/ kg</span>
        </div>

        <div style="display:flex; align-items:center; gap:5px;">
            <input type="number" name="stock"
                placeholder="Stock"
                value="{{ $menu->stock ?? '' }}"
                required>
            <span>kg</span>
        </div>

        <button type="submit">
            {{ isset($menu) ? 'Update' : 'Add' }}
        </button>

    </div>
</form>

<hr>


<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Category</th>
        <th>Price / kg</th>
        <th>Stock</th>
        <th>Status</th>
        <th>Action</th>
    </tr>

    @foreach($menus as $menuItem)
    <tr>
        <td>{{ $menuItem->id }}</td>
        <td>{{ $menuItem->name }}</td>
        <td>{{ $menuItem->category }}</td>
        <td>₱{{ $menuItem->price_per_kilo }}</td>
        <td>{{ $menuItem->stock }} kg</td>

        <td>
            @if($menuItem->stock <= 0)
                <span style="color:red;">Out of Stock</span>
            @elseif($menuItem->stock < 10)
                <span style="color:orange;">Low Stock</span>
            @else
                <span style="color:green;">Available</span>
            @endif
        </td>

        <td>
            <a href="{{ route('menu.edit', $menuItem->id) }}">Edit</a>

            |

            <form action="{{ route('menu.delete', $menuItem->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('Delete this item?')">
                    Delete
                </button>
            </form>
        </td>
    </tr>
    @endforeach
</table>