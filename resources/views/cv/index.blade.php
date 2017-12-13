@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            @if(session()->has('success'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    <h4> {{session()->get('success')}} </h4>
                </div>
            @endif
            <div class="panel panel-default">
                <div class="pull-right new-cv">
                    <a href="{{url('cvs/create')}}" class="btn btn-success">New cv</a>
                </div>
                <div class="panel-heading">
                    La liste des cvs
                    
                </div>
                <div class="panel-body">
                    @if(count($cvs) > 0)
                        <div class="row">
                            @foreach ($cvs as $cv)
                                <div class="col-sm-6 col-md-4">
                                    <div class="thumbnail">
                                      <img src=" {{asset('storage/'.$cv->image)}} " width="150" height="150" alt="...">
                                      <div class="caption">
                                        <h3> {{$cv->titre}} </h3>
                                        <p>{{$cv->description}} </p>
                                        
                                        <form class="form-horizontal" role="form" method="POST" action="{{url('cvs/'.$cv->id)}}">
                                            <input type="hidden" name="_method" value="DELETE">
                                            {{ csrf_field() }}
                                            <a href="{{url('cvs/'.$cv->id.'/show')}}" class="btn btn-primary" role="button">Details</a> 
                                            <a href=" {{url('cvs/'.$cv->id.'/edit')}} " class="btn btn-default" role="button">Edit</a>
                                            <input type="submit" value="delete" class="btn btn-danger">
                                        </form>
                                      </div>
                                    </div>
                                </div>
                              @endforeach
                        </div>
                    @else
                        <p>No results found</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
