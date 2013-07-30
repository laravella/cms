@extends('cms::layouts.default')

{{-- Web site Title --}}
@section('title')
@parent :: CMSView
@stop

@section('extra_head')
    <style>
        table.dbtable td {
            border : 1px solid #303030;
        }
    </style>
@stop

@section('install')
    @if($action == 'install')
        <div class="page-header">
        <h1>Install</h1>
        </div>
        <table>
        @foreach($log as $logitem)
            <tr><td><span class="label label-{{$logitem['severity']}}">{{$logitem['severity']}}</span></td><td>{{$logitem['message']}}</td></tr>
        @endforeach
        </table>
    @endif
@stop

@section('index')
    @if($action == 'index')
        <div class="page-header">
        <h1>Index</h1>
        </div>
        <ul>
        <li><a href="/cmsinstall/install">Install</a></li>
        <li><a href="/cmsinstall/reinstall">Reinstall</a></li>
        <li><a href="/cms/select/_db_tables">List Tables</a></li>
        </ul>
    @endif
@stop

@section('content')
    @yield($action)
@stop

