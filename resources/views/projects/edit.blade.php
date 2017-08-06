@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Редактировать проект</h1>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            {!! Form::model($project, ['method' => 'put', 'route' => ['projects.update', $project->id], 'class' => 'form']) !!}

            <div class="form-group">
                {!! Form::label('note', 'Имя проекта') !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => '']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('note', 'URL проекта') !!}
                {!! Form::text('url', null, ['class' => 'form-control', 'placeholder' => '']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('note', 'ID метрики') !!}
                {!! Form::text('metric', null, ['class' => 'form-control', 'placeholder' => '', 'readonly']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('note', 'ID SEranking') !!}
                {!! Form::text('se_ranking', null, ['class' => 'form-control', 'placeholder' => '', 'readonly']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('note', 'Отчетное число') !!}
                {!! Form::number('', null, ['class' => 'form-control', 'max' => '31', 'min' => '1']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Обновить', ['class' => 'btn btn-primary']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>
@endsection