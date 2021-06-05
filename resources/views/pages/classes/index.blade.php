@extends('layouts.app', ['activePage' => 'classes', 'titlePage' => __('Aulas')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div>
                        <a href="{{ route('substitutes.create') }}" class="btn btn-primary">
                            <i class="material-icons">add</i>
                            Substituição
                        </a>
                    </div>
                    <div>
                        @foreach ($substitutes as $substitute)
                            <p>
                                {{ $substitute->subject->teacher
                                    ? "O professor {$substitute->subject->teacher} ({$substitute->subject->name})
                                    será substituido"
                                    : "A matéria de {$substitute->subject->name} será substituída" }}
                                a partir do dia {{ date('d/m/Y', strtotime($substitute->start)) }}
                                {{ $substitute->subject->substitute
                                    ? ' pelo(a) professor(a) ' . $substitute->subject->substitute
                                    : ''
                                }} {{ $substitute->end
                                ? ' até o dia ' . date('d/m/Y', strtotime($substitute->end))
                                : ''
                            }}
                                <a href="{{ route('substitutes.destroy', $substitute->id) }}" class="confirmDelete">
                                    <i class="material-icons">delete</i>
                                </a>
                            </p>
                        @endforeach
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="text-primary">
                                    <tr>
                                        <th>
                                            Segunda
                                            <div>
                                                <a href="{{ route('classes.edit', 1) }}"><i
                                                        class="material-icons">edit</i></a>
                                                <a href="{{ route('classes.destroy', 1) }}" class="confirmDelete">
                                                    <i class="material-icons">delete</i>
                                                </a>
                                            </div>
                                        </th>
                                        <th>
                                            Terça
                                            <div>
                                                <a href="{{ route('classes.edit', 2) }}"><i
                                                        class="material-icons">edit</i></a>
                                                <a href="{{ route('classes.destroy', 2) }}" class="confirmDelete">
                                                    <i class="material-icons">delete</i>
                                                </a>
                                            </div>
                                        </th>
                                        <th>
                                            Quarta
                                            <div>
                                                <a href="{{ route('classes.edit', 3) }}"><i
                                                        class="material-icons">edit</i></a>
                                                <a href="{{ route('classes.destroy', 3) }}" class="confirmDelete">
                                                    <i class="material-icons">delete</i>
                                                </a>
                                            </div>
                                        </th>
                                        <th>
                                            Quinta
                                            <div>
                                                <a href="{{ route('classes.edit', 4) }}"><i
                                                        class="material-icons">edit</i></a>
                                                <a href="{{ route('classes.destroy', 4) }}" class="confirmDelete">
                                                    <i class="material-icons">delete</i>
                                                </a>
                                            </div>
                                        </th>
                                        <th>
                                            Sexta
                                            <div>
                                                <a href="{{ route('classes.edit', 5) }}"><i
                                                        class="material-icons">edit</i></a>
                                                <a href="{{ route('classes.destroy', 5) }}" class="confirmDelete">
                                                    <i class="material-icons">delete</i>
                                                </a>
                                            </div>
                                        </th>
                                        <th>
                                            Sabado
                                        </th>
                                        <th>
                                            Domingo
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody id="tableBody">
                                    <?php
                                    foreach ($rangeOfDays as $day) {
                                        $printable = '';
                                        $dayFormatW = $day->format('w');
                                        if ($dayFormatW == 1) {
                                            $printable .= '<tr>';
                                        }

                                        $printable .= "<td>{$day->format('d')}";

                                        if (!empty($classes[$dayFormatW])) {
                                            $printable .= ' - ' . implode(', ', $classes[$dayFormatW]);
                                        }

                                        $printable .= "</td>";

                                        if ($dayFormatW == 0) {
                                            $printable .= '</tr>';
                                        }
                                        echo $printable;
                                    }
                                    ?>
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
    <script>
        $(document).ready(function () {
            $('.confirmDelete').click(function (e) {
                if (!confirm('Você realmente deseja excluir? Essa ação é irreversível!')) {
                    e.preventDefault();
                }
            });

            let $tableBody = $('#tableBody');
            let lastSaturday = $tableBody.find('td').eq(33);
            let penultimate = $tableBody.find('td').eq(26);
            let antepenultimate = $tableBody.find('td').eq(19);

            if (parseInt(lastSaturday.html()) > 15) {
                lastSaturday.html(lastSaturday.html() + ' - Matemática, Geografia, História e Física')
                penultimate.html(penultimate.html() + ' - Português, Inglês, Espanhol, Literatura')
            } else {
                penultimate.html(penultimate.html() + ' - Matemática, Geografia, História e Física')
                antepenultimate.html(antepenultimate.html() + ' - Português, Inglês, Espanhol, Literatura')
            }
        });
    </script>
@endpush
