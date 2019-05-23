
<!DOCTYPE html>
<html>
 <head>
        <title>@yield('title')</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

        <!-- jQuery AND jQueryUI -->
<script src="/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="/admin/js/libs/jquery/1.6/jquery.min.js"></script>
<script type="text/javascript" src="/admin/js/libs/jqueryui/1.8.13/jquery-ui.min.js"></script>      
 <link rel="stylesheet" href="/admin/css/min.css" />
 <script type="text/javascript" src="/admin/js/min.js"></script>
 <script type="text/javascript" src="/admin/content/settings/main.js"></script>
 <link rel="stylesheet" href="/admin/content/settings/style.css" />        
    </head>
    <body>       
             @php
                $us = DB::table('admin')->where('id',session('uid'))->first();
             @endphp

        <!--              
                HEAD
                        --> 
        <div id="head">
            <div class="left">
                <a href="/admin/profile" class="button profile"><img src="{{$us->head}}" alt="" style="width:100%"/></a>
                Hello,{{$us->username}}
                <a href="/admin/pass">修改密码</a>
                |
                <a href="/admin/logout">退出</a>
            </div>
            <div class="right">
                <form action="#" id="search" class="search placeholder">
                    <label>请输入搜索内容 ?</label>
                    <input type="text" value="" name="q" class="text"/>
                    <input type="submit" value="rechercher" class="submit"/>
                </form>
            </div>
        </div>
                
        <!--            
                SIDEBAR
                         --> 
        <div id="sidebar">
            <ul>
              
                <li><a href="#"><img src="/admin/img/icons/menu/brush.png" alt="" /> 管理员管理</a>
                    <ul>
                        <li><a href="/list/create">添加用户</a></li>
                        <li><a href="/list">浏览用户</a></li>
                    </ul>
                </li>
              
                <li><a href="#"><img src="/admin/img/icons/menu/brush.png" alt="" /> 分类管理</a>
                    <ul>
                        <li><a href="/admin/type/create">添加分类</a></li>
                        <li><a href="/admin/type">浏览分类</a></li>
                    </ul>
                </li>
                
            </ul>
        </div>     
        <!--            
              CONTENT中心位置 
                        --> 
        <div id="content" class="white">
            @section('content')
                 
            @show
            <div class="cb"></div>
           @section('js')


          @show
        </div>
          
       
    </body>
</html>