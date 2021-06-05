@extends('layouts.app', ['activePage' => 'classes', 'titlePage' => __('Edição de matérias')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form id="classesForm" action="{{ route('classes.update', $dayOfWeek) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="class1" class="text-primary">Aula 1</label>
                            <select class="form-control" id="class1" name="subjects[]" required>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="class2" class="text-primary">Aula 2</label>
                            <select class="form-control" id="class2" name="subjects[]" required>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="class3" class="text-primary">Aula 3</label>
                            <select class="form-control" id="class3" name="subjects[]" required>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="class4" class="text-primary">Aula 4</label>
                            <select class="form-control" id="class4" name="subjects[]" required>

                            </select>
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
    <script>
        let availableSubjects = [];
        let usedSubjects = [];

        function getAvailableSubjects() {
            $.ajax({
                type: 'get',
                url: `${baseURI}/classes/<?= $dayOfWeek ?>/availableSubjects`,
                success: function (response) {
                    availableSubjects = response.data;
                    populateSelects();
                }
            });
        }

        function populateSelects(to = null, changedSelect = null) {
            $.each($('select'), function (key, select) {
                let $select = $(select);

                let options = '';

                if (to) {
                    $.each(usedSubjects, function (key, usedSubject) {
                        if ($select.prop('id') === changedSelect.prop('id')) {
                            if (usedSubject.id === parseInt(to)) {
                                options = `<option value="${usedSubject.id}" selected>${usedSubject.name}</option>`;
                                $select.data('old', usedSubject.id);
                            }
                        } else {
                            if (usedSubject.id === $select.data('old')) {
                                options = `<option value="${usedSubject.id}" selected>${usedSubject.name}</option>`;
                                $select.data('old', usedSubject.id);
                            }
                        }
                    });
                }

                if (!options) {
                    options = '<option hidden disabled selected value>Selecione uma matéria</option>';
                }

                $.each(availableSubjects, function (key, availableSubject) {
                    options += `<option value="${availableSubject.id}">${availableSubject.name}</option>`;
                });

                $select.html(options);
            });
        }

        function switchAvailable(from, to) {
            if (from) {
                let fromObj = {};
                $.each(usedSubjects, function (key, usedSubject) {
                    if (usedSubject.id === parseInt(from)) {
                        fromObj = usedSubject;

                        delete usedSubjects[key];
                        usedSubjects = usedSubjects.filter(x => x);
                        return false;
                    }
                });

                availableSubjects.push(fromObj);
            }

            let toObj = {};
            $.each(availableSubjects, function (key, availableSubject) {
                if (availableSubject.id === parseInt(to)) {
                    toObj = availableSubject;
                    delete availableSubjects[key];
                    availableSubjects = availableSubjects.filter(x => x);
                    return false;
                }
            });

            usedSubjects.push(toObj);
        }

        function switchAvailableAndRepopulate(from, to, changedSelect) {
            switchAvailable(from, to);
            populateSelects(to, changedSelect);
        }

        $(document).ready(function () {
            getAvailableSubjects();
        });

        let $classesForm = $('#classesForm');
        $classesForm.on('focusin', 'select', function () {
            let $this = $(this);

            let selectedOptionValue = $this.find('option').filter(':selected').val();

            $this.data('old', selectedOptionValue);
        });

        $classesForm.on('change', 'select', function () {
            let $this = $(this);

            let selectedOptionValue = $this.find('option').filter(':selected').val();

            switchAvailableAndRepopulate($this.data('old'), selectedOptionValue, $this);
        });
    </script>
@endpush
