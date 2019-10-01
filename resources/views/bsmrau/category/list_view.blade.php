<div class="table-responsive">
    <table class="table align-items-center table-flush">
        <thead class="thead-light">
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
                <tr>
                <td>{{ $category->name }}</td>
                <td>
                    <button class="btn btn-primary btn-sm" data-target="#editModal" data-toggle="modal" onclick="editValue('{{ $category->id }}')" type="button"><i class="fas fa-user-edit"></i></button>
                    @if($category->active==1)
                    <button class="btn btn-warning btn-sm" onclick="deactive('{{ $category->id }}')" type="button"><i class="fas fa-times"></i></button>
                    @else
                    <button class="btn btn-success btn-sm" onclick="active('{{ $category->id }}')" type="button"><i class="fas fa-check"></i></button>
                    @endif
                    <button class="btn btn-danger btn-sm" onclick="deleteValue('{{ $category->id }}')" type="button"><i class="fas fa-trash"></i></button>
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