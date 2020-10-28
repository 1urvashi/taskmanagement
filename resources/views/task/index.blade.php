@extends('task.layout')
 
@section('content')
    <br/>
    <br/>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Task Management</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('tasks.create') }}"> Create New Task</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table id="table" class="table table-bordered">
        <thead>
        <tr>
            <th width="30px">#</th>
            <th>Project Name</th>
            <th>Name</th>
            <th>Created At</th>
            <th width="280px">Action</th>
        </tr>
        </thead>
        <tbody id="tablecontents">
        @foreach ($tasks as $task)
        <tr class="row1" data-id="{{ $task->id }}">
            <td class="pl-3"><i class="fa fa-sort"></i></td>
            <td>{{ $task->project_name }}</td>
            <td>{{ $task->name }}</td>
            <td>{{ date('d-m-Y h:m:s',strtotime($task->created_at)) }}</td>
            <td>
                <form action="{{ route('tasks.destroy',$task->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('tasks.show',$task->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('tasks.edit',$task->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
        </tbody>  
    </table>
  
    {!! $tasks->links() !!}
      
@endsection

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>   
<script type="text/javascript">

    var base_url = '{{URL::to('')}}';

    $(function () {
    $("#table").DataTable();

    $( "#tablecontents" ).sortable({
        items: "tr",
        cursor: 'move',
        opacity: 0.6,
        update: function() {
            sendTaskToServer();
        }
    });

    function sendTaskToServer() {
        var priority = [];
        var token = $('meta[name="csrf-token"]').attr('content');
        $('tr.row1').each(function(index,element) {
        priority.push({
            id: $(this).attr('data-id'),
            position: index+1
        });
        });

        $.ajax({
        type: "POST", 
        dataType: "json", 
        url: base_url + '/xhr/tasksortabledatatable',
            data: {
            priority: priority,
            _token: "<?= csrf_token() ?>"
        },
        success: function(response) {
            if (response.status == "success") {
                console.log(response);
            } else {
                console.log(response);
            }
        }
        });
    }
    });
</script>