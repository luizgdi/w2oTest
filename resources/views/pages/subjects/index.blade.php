@extends('layouts.app', ['activePage' => 'subjects', 'titlePage' => __('Matérias')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="text-primary">
                                    <tr>
                                        <th>
                                            ID
                                        </th>
                                        <th>
                                            Nome
                                        </th>
                                        <th>
                                            Professor
                                        </th>
                                        <th>
                                            Substituto
                                        </th>
                                        <th>
                                            Editar
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($subjects as $subject)
                                        <tr>
                                            <td>{{ $subject->id }}</td>
                                            <td>{{ $subject->name }}</td>
                                            <td>{{ $subject->teacher }}</td>
                                            <td>{{ $subject->substitute }}</td>
                                            <td>
                                                <a href="{{ route('subjects.edit', $subject->id) }}">
                                                    <i class="material-icons">edit</i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')

@endpush
