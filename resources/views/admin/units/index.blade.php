
@extends('admin.index')
@section('content')

    <div class="container">

        <section class="content">

            <div class="box-body">
                <table id="branches_datatable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr>
                        <th>اسم الوحده</th>
                        <th>حذف</th>

                    </tr>
                    </thead>
                    <tbody id="users-crud">
                    @foreach($units as $unit)
                        <tr id="unit_id_{{ $unit->id }}">
                            <td>{{ $unit->name }}</td>


{{--                            <td><a href="javascript:void(0)" id="edit-user" data-id="{{ $unit->id }}" class="btn btn-info">Edit</a></td>--}}
                            <td>
                                <a href="/units/delete/{{$unit->id }}" id="delete-user" data-id="{{ $unit->id }}" class="btn btn-danger delete-user fa  fa-trash"></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </section>
    </div>



@endsection
