<div class="table-responsive">
    <table class="table align-items-center table-flush">
        <thead class="thead-light">
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Designation</th>
                <th scope="col">Category</th>
                <th scope="col">Sub-Category</th>
                <th scope="col">Sub-Sub-Category</th>
                <th scope="col">Contact</th>
                <th scope="col">Email</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($persons as $person)
                <tr>
                    <td class="table-user">
                        @if($person->image)
                        <img src="{{ $person->image }}" class="avatar rounded-circle mr-3">
                        @else
                        <img src="/persons/user.png" class="avatar rounded-circle mr-3">
                        @endif
                        <b>{{ $person->name }}</b>
                    </td>
                    <td>{{ $person->designation_name }}</td>
                    <td>{{ $person->category_name }}</td>
                    <td>{{ $person->sub_category_name }}</td>
                    <td>{{ $person->sub_sub_category_name }}</td>
                    <td>{{ $person->contact }}</td>
                    <td>{{ $person->email }}</td>
                    <td>
                        <button class="btn btn-primary btn-sm" data-target="#editModal" data-toggle="modal" onclick="editValue('{{ $person->id }}')" type="button"><i class="fas fa-user-edit"></i></button>
                        @if($person->active==1)
                        <button class="btn btn-warning btn-sm" onclick="deactive('{{ $person->id }}')" type="button"><i class="fas fa-times"></i></button>
                        @else
                        <button class="btn btn-success btn-sm" onclick="active('{{ $person->id }}')" type="button"><i class="fas fa-check"></i></button>
                        @endif
                        <button class="btn btn-danger btn-sm" onclick="deleteValue('{{ $person->id }}')" type="button"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="card-footer py-4">
    <nav aria-label="...">
        {!! $persons->links() !!}
    </nav>
</div>