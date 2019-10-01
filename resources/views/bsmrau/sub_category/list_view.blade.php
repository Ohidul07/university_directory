<div class="table-responsive">
    <table class="table align-items-center table-flush">
        <thead class="thead-light">
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Category</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sub_categories as $subcategory)
                <tr>
                <td>{{ $subcategory->name }}</td>
                <td>{{ $subcategory->category_name }}</td>
                <td>
                    <button class="btn btn-primary btn-sm" data-target="#editModal" data-toggle="modal" onclick="editValue('{{ $subcategory->id }}')" type="button"><i class="fas fa-user-edit"></i></button>
                    @if($subcategory->active==1)
                    <button class="btn btn-warning btn-sm" onclick="deactive('{{ $subcategory->id }}')" type="button"><i class="fas fa-times"></i></button>
                    @else
                    <button class="btn btn-success btn-sm" onclick="active('{{ $subcategory->id }}')" type="button"><i class="fas fa-check"></i></button>
                    @endif
                    <button class="btn btn-danger btn-sm" onclick="deleteValue('{{ $subcategory->id }}')" type="button"><i class="fas fa-trash"></i></button>
                </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="card-footer py-4">
    <nav aria-label="...">
    </nav>
</div>