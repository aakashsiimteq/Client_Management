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
        <thead class="bg-primary" style="border: 1px solid #ccc">
            <tr>
                <th style="border: 1px solid #174993">#</th>
                <th style="border: 1px solid #174993">Project id</th>
                <th style="border: 1px solid #174993">Project title</th>
                <th style="border: 1px solid #174993">Type</th>
                <th style="border: 1px solid #174993">Customer name</th>
                <th style="border: 1px solid #174993">Start Date</th>
                <th style="border: 1px solid #174993">End Date</th>
                <th style="border: 1px solid #174993">Project cost</th>
                <th style="border: 1px solid #174993">Status</th>
                <th style="border: 1px solid #174993">Action</th>
            </tr>
        </thead>
        @php
            $count = 0;
        @endphp
        <tbody>
            @foreach($projects as $project)
                <tr>
                    <td style="border: 1px solid #dedede">{{++$count}}</td>
                    <td style="border: 1px solid #dedede"><a href="project/{{$project->project_id}}/edit">{{$project->project_number}}</a></td>
                    <td style="border: 1px solid #dedede">{{$project->project_name}}</td>
                    <td style="border: 1px solid #dedede">{{$project->project_type}}</td>
                    <td style="border: 1px solid #dedede">{{$project->customer_name}}</td>
                    <td style="border: 1px solid #dedede">{{\Carbon\Carbon::parse($project->project_start_date)->toFormattedDateString()}}</td>
                    <td style="border: 1px solid #dedede">{{\Carbon\Carbon::parse($project->project_end_date)->toFormattedDateString()}}</td>
                    <td style="border: 1px solid #dedede">A$ {{$project->project_estimate_cost}}</td>
                    <td style="border: 1px solid #dedede">{{$project->project_status}}</td>
                    <td style="border: 1px solid #dedede">
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
