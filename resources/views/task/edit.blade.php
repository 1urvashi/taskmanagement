@extends('task.layout')
   
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Task</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('tasks.index') }}"> Back</a>
            </div>
        </div>
    </div>
   
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
  
    <form action="{{ route('tasks.update',$task->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Project:</strong>
                <select name="project_name" class="form-control">
                    <option value="project1" {{ ( $task->project_name == "project1" ) ? 'selected' : '' }}>project1</option>
                    <option value="project2" {{ ( $task->project_name == "project2" ) ? 'selected' : '' }}>project2</option>
                    <option value="project3" {{ ( $task->project_name == "project3" ) ? 'selected' : '' }}>project3</option>
                    <option value="project4" {{ ( $task->project_name == "project4" ) ? 'selected' : '' }}>project4</option>
                    <option value="project5" {{ ( $task->project_name == "project5" ) ? 'selected' : '' }}>project5</option>
                </select>
            </div>
        </div>
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" value="{{ $task->name }}" class="form-control" placeholder="Name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
   
    </form>
@endsection