@extends('layout.index') @section('title', 'Project')

@section('content')

    <div class="row">
        <div class="col-md-3">
            <label for="search_table" class="control-label">Search Projects</label>
            <input type="text" name="search_table" id="search_table" placeholder="Search Projects" class="form-control" />
        </div>
    </div>

<div class="panel panel-primary" style="margin-top: 2%;">
  <div class="panel-heading">
    <h3 class="panel-title">View Project</h3>
  </div>
  <div class="panel-body">
    <table class="table text-center table-bordered table-hover" id="searchtable">
        <thead>
            <th>Sr no.</th>
            <th>Project id</th>
            <th>Project title</th>
            <th>Type</th>
            <th>Customer name</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Estimated cost</th>
            <th>Status</th>
            <th>Action</th>
        </thead>
        @php
            $count = 0;
        @endphp
        <tbody>
            @foreach($projects as $project)
                <tr>
                    <td>{{++$count}}</td>
                    <td>{{$project->project_number}}</td>
                    <td>{{$project->project_name}}</td>
                    <td>{{$project->project_type}}</td>
                    <td>{{$project->customer_name}}</td>
                    <td>{{$project->project_start_date}}</td>
                    <td>{{$project->project_end_date}}</td>
                    <td>A$ {{$project->project_estimate_cost}}</td>
                    <td>{{$project->project_status}}</td>
                    <td>
                      {!!Html::linkRoute('project.edit', 'Edit', array($project->project_id), array('class' => 'btn btn-primary btn-sm'))!!}
                      <div style="display: inline-block">
                        {!!Form::open(['route' => ['project.destroy', $project->project_id], 'method' => 'DELETE'])!!}
                            {{Form::submit('Delete', ['class' => 'btn btn-danger btn-sm'])}}
                        {!!Form::close()!!}
                      </div>
                      {!!Html::linkRoute('project-invoice.edit', 'Make Invoice', array($project->project_id), array('class' => 'btn btn-warning btn-sm'))!!}

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

  </div>
</div>

@endsection
