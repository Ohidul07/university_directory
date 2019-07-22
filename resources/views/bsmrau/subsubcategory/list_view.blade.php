<div class="table-responsive">
    <table class="table align-items-center table-flush">
        <thead class="thead-light">
            <tr>
                <th scope="col">SubSubCategory Name</th>
                <th scope="col">SubCategory Name</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($subsubcategories as $subsubcategory)
                <tr>
                <td>{{ $subsubcategory->name }}</td>
                <td>{{ $subsubcategory->subcategory->name }}</td>
                <td>
                    <button class="btn btn-primary btn-sm" data-target="#editModal" data-toggle="modal" onclick="editValue('{{ $subsubcategory->id }}')" type="button"><i class="fas fa-user-edit"></i></button> 
                    <button class="btn btn-danger btn-sm" onclick="deleteValue('{{ $subsubcategory->id }}')" type="button"><i class="fas fa-trash"></i></button>
                </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="card-footer py-4">
    <nav aria-label="...">
        {!! $subsubcategories->links() !!}
    </nav>
</div>