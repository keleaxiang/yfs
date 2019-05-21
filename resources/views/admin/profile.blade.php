@extends('common.admins')

@section('title',$title)

@section('content')
   <div class="bloc">
    <div class="title">{{$title}}<a href="#" class="toggle"></a></div>
    <div class="content">
        <form id="art_form" class="mws-form" action="/admin/user" method='post' enctype='multipart/form-data'>
        <div class="input">
            <label for="file">头像</label>
            <img id='imgs' src="{{$rs->head}}" alt="" style="width:240px">
            <input id='file_upload' type="file" name='file_upload' style="position: absolute; top: 0px; right: 0px; margin: 0px; cursor: pointer; font-size: 999px; opacity: 0; z-index: 999;">
        </div>
        
        <div class="submit">
            {{csrf_field()}}
        </div>
    </form>
</div>

@stop

@section('js')
<script>

	// alert($);

	//文档加载
	$(function () {
        $("#file_upload").change(function () {
				//  判断是否有选择上传文件
		        var imgPath = $("#file_upload").val();

		        if (imgPath == "") {
		            alert("请选择上传图片！");
		            return;
		        }
		        //判断上传文件的后缀名
		        var strExtension = imgPath.substr(imgPath.lastIndexOf('.') + 1);
		        if (strExtension != 'jpg' && strExtension != 'gif'
		            && strExtension != 'png') {
		            alert("请选择图片文件");
		            return;
		        }

		        var formData = new FormData($('#art_form')[0]);
		       	$.ajax({
		            type: "POST",
		            url: "/admin/upload",
		            data: formData,
		            contentType: false,
		            processData: false,
		            success: function(data) {
		                $('#imgs').attr('src',data);

		                location.href ='/admin/profile';
		            },

		            error: function(XMLHttpRequest, textStatus, errorThrown) {
		                alert("上传失败，请检查网络后重试");
		            }
		        });
        })
    })
</script>


@stop