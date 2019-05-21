@extends('common/admins')


@section('title',$title)

@section('content')
<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span>
            <i class="icon-table">
            </i>
            {{$title}}
        </span>
    </div>
    
    @if(session('success'))
    <div class="mws-form-message info">
        {{session('success')}}
    </div>
    @endif
 <div class="bloc">
    <div class="title">
        用户的列表页面
    <a href="#" class="toggle"></a></div>
    <div class="content">
        <form action="/admin/nav" method='get'>
                <div id="DataTables_Table_1_length" class="dataTables_length">
                    <label>
                        显示
                        <select size="1" name="num" aria-controls="DataTables_Table_1">
                            <option value="10" @if($request->num == '10') selected="selected" @endif >
                                10
                            </option>
                            <option value="20" @if($request->num == '20') selected="selected" @endif>
                                20
                            </option>
                            <option value="30" @if($request->num == '30') selected="selected" @endif>
                                30
                            </option>
                            
                        </select>
                        条数据
                    </label>
                    <div class="dataTables_filter" id="DataTables_Table_1_filter">
                    
                    <label>
                        分类名:
                        <input type="text" name='name' aria-controls="DataTables_Table_1" value="{{$request->name}}">
                    </label>
                    <button class='btn btn-info'>搜索</button>
                </div>
            </form>
        <table>
            <thead>
                <tr>
                    <th><input type="checkbox" class="checkall"></th>
                    <th>ID</th>
                    <th>用户名</th>
                    <th>邮箱</th>
                    <th>手机号</th>
                    <th>状态</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                 @foreach($rs as $k => $v)
               <tr>
                    <td><input type="checkbox"></td>
                    <td>{{$v->id}}</td>
                    <td>{{$v->username}}</td>
                    <td>{{$v->email}}</td>
                    <td>{{$v->phone}}</td>
                    <td><a href="#" title="Edit this content">
                        @if($v->status == 1)
                                开启
                            @else
                                禁用
                            @endif
                    </a></td>
                    <td>
                            
                            <a class="btn btn-default" href="/admin/user/{{$v->id}}/edit">修改</a>


                            <form action="/admin/user/{{$v->id}}" method='post' style='display: inline'>
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                                <button class="btn btn-default">删除</button>
                            </form>
                        </td>
                </tr>
               @endforeach        
        </tbody>
        </table>
        <div class="left input">
           
        </div>
        <div class="pagination">
            <a href="#" class="prev">«</a>
            <a href="#">1</a>
            <a href="#" class="current">2</a>
            ...
            <a href="#">21</a>
            <a href="#">22</a>
            <a href="#" class="next">»</a>
        </div>
    </div>
</div>
@stop
