@extends('common/admins')

@section('title',$title)

@section('content')
	<div class="mws-panel grid_8">
    	<div class="mws-panel-header">
        	<span>{{$title}}</span>
        </div>
            
<div class="bloc">
    <div class="title">{{$title}}<a href="#" class="toggle"></a></div>
    <div class="content">
        <form class="mws-form" action="/admin/type" method='post' enctype='multipart/form-data'>
        <div class="input">
            <label for="input1">分类名</label>
            <input type="text" id="input1" name="tname">
        </div>
        
        <div class="input">
            <label for="select">分类列表</label>
            <div class="selector" id="uniform-select"><span>First value</span><select name="pid" id="select" style="opacity: 0;">
                <option value='0'>
                                请选择
                            </option>
                            @foreach($rs as $k => $v)
                            <option value='{{$v->tid}}'>
                                {{$v->tname}}
                            </option>
                            @endforeach
          
            </select></div>
        </div>

        <div class="input">
            <label class="label">状态</label>
            <div class="radio" id="uniform-radio1"><span class="checked"><input type="radio" id="radio1" checked="checked" style="opacity: 0;" value="1" name="status"></span></div><label for="radio1" class="inline">开启</label> <br>
            <div class="radio" id="uniform-radio2"><span><input type="radio" id="radio2"  style="opacity: 0;" value="0" name="status"></span></div><label for="radio2" class="inline">禁用</label>
        </div>
        
       

        <div class="submit">
            {{csrf_field()}}
            <input type="submit" value="添加" class="btn btn-primary"> 
        </div>
    </form>
</div>

@stop

