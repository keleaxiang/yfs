@extends('common/admins')


@section('title',$title)

@section('content')
<div class="bloc">
    <div class="title">
        用户列表页面
    <a href="#" class="toggle">
    </a></div>
     @if(session('success'))
    <div class="mws-form-message info">
        {{session('success')}}
    </div>
    @endif
    <div class="content">
        <table>
            <thead>
                <tr>
                    <th><input type="checkbox" class="checkall"></th>
                    <th>ID</th>
                    <th>分类名</th>
                    <th>父级id</th>
                    <th>路径</th>
                    <th>状态</th>
                    <th>操作</th>
                </tr>
            </thead>
            <form action="/admin/type" method='get'>
            <div class="dataTables_filter" id="DataTables_Table_1_filter" style="float:right;">
                    <label>
                        用户名:
                        <input type="text" name='tname' aria-controls="DataTables_Table_1">
                        <button class='btn btn-info'>搜索</button>
                    </label>
                </div>
            </form>
            <tbody>
                 @foreach($rs as $k => $v)
                 <tr>
                    <td><input type="checkbox"></td>
                    <td>{{$v->id}}</td>
                    <td>{{$v->tname}}</td>
                    <td>{{$v->pid}}</td>
                    <td>{{$v->path}}</td>
                    <td>
                          
                            @if($v->status == 1)
                              开启
                            @else
                              关闭
                            @endif
                         
                      <!-- {{$v->status ? '开启' : '禁用'}} -->
                    </td>
                    <td class="actions"><a href="/admin/type/{{$v->tid}}/edit" title="Edit this content">修改</a>
                        <form action="/admin/type/{{$v->tid}}" method='post' style='display: inline'>
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                                <button class='btn btn-danger'>删除</button>
                         </form>
                </tr>
                @endforeach
             </tbody>
        </table>
        <div class="left input" style="margin-top: 15px">
                显示 {{$rs->firstItem()}} to {{$rs->lastItem()}} of {{$rs->count()}} 条数据  总共是{{$rs->total()}}条数据
        </div>
       
            <style>
                .pagination{

                    margin:0px;
                }

                .pagination li{
                        float: left;
                        height: 20px;
                        padding: 0 10px;
                        display: block;
                        font-size: 12px;
                        line-height: 20px;
                        text-align: center;
                        cursor: pointer;
                        outline: none;
                }

                .pagination a{
                     color: #fff;
                }

                .pagination .active{
                    
                    color: #323232;
                    border: none;
                    background-image: none;
                    box-shadow: inset 0px 0px 4px rgba(0, 0, 0, 0.25);
                    background-color: #f08dcc;
                }

            </style>
        <div class="pagination">
             {{$rs->appends($request->all())->links()}}
        </div>
    </div>
</div>

@stop
@section('js')
  <script>
      
    setTimeout(function(){

        $('.mws-form-message').hide(1200)
    },2000)  
  </script>
 


@stop