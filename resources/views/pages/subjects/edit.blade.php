@extends('layouts.app', ['activePage' => 'subjects', 'titlePage' => __('Matérias')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('subjects.update', $subject->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="subject" class="text-primary">Matéria</label>
                            <input type="text" class="form-control" id="subject" value="{{ $subject->name }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="teacher" class="text-primary">Professor</label>
                            <input type="text" class="form-control" id="teacher" name="teacher"
                                   value="{{ $subject->teacher }}"
                                   placeholder="João" required>
                        </div>
                        <div class="form-group">
                            <label for="substitute" class="text-primary">Substituto</label>
                            <input type="text" class="form-control" id="substitute" name="substitute"
                                   value="{{ $subject->substitute }}" placeholder="Zé">
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

@push('js')

@endpush
