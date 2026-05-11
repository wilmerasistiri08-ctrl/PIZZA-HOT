@foreach($products as $product)
<tr>
    <td>{{ $product->name }}</td>
    <td>{{ $product->price }}</td>

    <td>
        <form method="POST" action="/admin/products/{{ $product->id }}">
            @csrf
            @method('PUT')

            <select name="is_available" onchange="this.form.submit()">
                <option value="1">Disponible</option>
                <option value="0">Agotado</option>
            </select>
        </form>
    </td>
</tr>
@endforeach