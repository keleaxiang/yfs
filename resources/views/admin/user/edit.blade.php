@extends('common/admins')

@section('title',$title)

@section('content')
	<div class="mws-panel grid_8">
    	<div class="mws-panel-header">
        	<span>{{$title}}</span>
        </div>
            
         @if (count($errors) > 0)
		    <div class="notif info error">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif

<div class="bloc">
    <div class="title">{{$title}}<a href="#" class="toggle"></a></div>
    <div class="content">
        <form class="mws-form" action="/admin/user/{{$rs->id}}" method='post' enctype='multipart/form-data'>
        <div class="input">
            <label for="input1">用户名</label>
            <input type="text" id="input1" name="username" value="{{$rs->username}}">
        </div>
       
          <div class="input">
            <label for="input1">邮箱</label>
            <input type="text" id="input1" name="email" value="{{$rs->email}}">
        </div>
          <div class="input">
            <label for="input1">手机号</label>
            <input type="text" id="input1" name="phone" value="{{$rs->phone}}">
        </div>

       <div class="input" >
        <div class="input">
            <label for="file">头像</label>
            <img src="{{$rs->head}}" style="width:250px">
            <div class="uploader" id="uniform-file"><input type="file" id="file" size="20" style="opacity: 0;" name="head"><span class="filename">No file selected</span><span class="action">Choose File</span></div>
        </div>
        </div>

        <div class="input">
            <label class="label">状态</label>
            <div class="radio" id="uniform-radio1"><span class="checked"><input type="radio" id="radio1" checked="checked" style="opacity: 0;" value="1" name="status" @if($rs->status==1)checked @endif></span></div><label for="radio1" class="inline">开启</label> <br>
            <div class="radio" id="uniform-radio2"><span><input type="radio" id="radio2"  style="opacity: 0;" value="0" name="status" @if($rs->status==0)checked @endif></span></div><label for="radio2" class="inline">禁用</label>
        </div>
        
        <div class="submit">
            {{csrf_field()}}

            {{method_field('PUT')}}
            <input type="submit" value="修改" class="btn btn-primary"> 
        </div>
    </form>
</div>

@stop
@section('js')

<script>
    //让错误的信息3秒钟之后消失
    /*setInterval(function(){


    },3000)*/

    setTimeout(function(){
        // $('.mws-form-message').slideUp(2000);
        $('.notif info').fadeOut(2000);

    },3000)

    // delay(3000).

    
</script>

@stop
