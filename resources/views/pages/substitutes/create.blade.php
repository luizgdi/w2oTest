@extends('layouts.app', ['activePage' => 'classes', 'titlePage' => __('Cadastro de substituição')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('substitutes.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="id_subject" class="text-primary">Matéria</label>
                            <select class="form-control" id="id_subject" name="id_subject" required>
                                <option hidden disabled selected value="">Selecione uma matéria</option>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="start" class="text-primary">De</label>
                            <input type="date" class="form-control" id="start" name="start" required>
                        </div>
                        <div class="form-group">
                            <label for="end" class="text-primary">Até</label>
                            <input type="date" class="form-control" id="end" name="end">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                Salvar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
