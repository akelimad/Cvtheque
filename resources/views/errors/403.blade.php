@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
		<div class="col-md-12 text-center">
			<h2>this page is unauthorized</h2>
			<a href="{{url('cvs')}}" class="btn btn-primary">Go back</a>
		</div>
    </div>
</div>
@endsection