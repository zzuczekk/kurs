@extends('master')
@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="card">
            <div class="panel-body">
           	@include('videos.errors')
            <!-- Formularz -->
            	{!! Form::open(['url'=>'videos', 'class'=>'form-horizontal']) !!}
            		@include('videos.form',['buttonText'=>'Dodaj video'])
                {!! Form::close()!!}

            </div>
        </div>
    </div>
</div>
@stop