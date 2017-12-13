@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update c.v</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('cvs/'.$cv->id) }}">
                        <input type="hidden" name="_method" value="PUT">
                        {{ csrf_field() }}

                        <div class="form-group @if($errors->get('titre')) has-error @endif">
                            <label for="titre" class="col-md-4 control-label">Title</label>
                            <div class="col-md-6">
                                <input id="titre" type="text" class="form-control" name="titre" value="{{$cv->titre}}" placeholder="Titre de C.V"  autofocus>
                                @if(count($errors->get("titre")))
                                    <ul class="list-unstyled">
                                        @foreach($errors->get("titre") as $error)
                                            <li>
                                                <span class="help-block">{{$error}}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>

                        <div class="form-group @if($errors->get('description')) has-error @endif">
                            <label for="description" class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
                                <textarea id="description" name="description" class="form-control" placeholder="presentation">{{$cv->description}}</textarea>
                                @if(count($errors->get("description")))
                                    <ul class="list-unstyled">
                                        @foreach($errors->get("description") as $error)
                                            <li> 
                                                <span class="help-block">{{$error}}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
