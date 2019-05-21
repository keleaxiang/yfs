@extends('common.admins')

@section('title',$title)

@section('content')
<div class="bloc">
    <div class="title">{{$title}}<a href="#" class="toggle"></a></div>
    <div class="content">
        <form class="mws-form" action="/admin/dopass" method='post' enctype='multipart/form-data'>
        <div class="input">
            <label for="input1">旧密码</label>
            <input type="password" id="input1" name="oldpass">
        </div>
        <div class="input">
            <label for="input1">新密码</label>
            <input type="password" id="input1" name="password">
        </div>
       <div class="input">
            <label for="input1">确认密码</label>
            <input type="password" id="input1" name="repass">
        </div>
        <div class="submit">
            {{csrf_field()}}
            <input type="submit" value="修改" class="btn btn-primary"> 
        </div>
    </form>
</div>
@stop
