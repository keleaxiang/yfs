
<!DOCTYPE html>
<html>
 <head>
        <title>@yield('title')</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

        
        <!-- jQuery AND jQueryUI -->
        <script type="text/javascript" src="/admin/js/libs/jquery/1.6/jquery.min.js"></script>
        <script type="text/javascript" src="/admin/js/libs/jqueryui/1.8.13/jquery-ui.min.js"></script>
        
        <link rel="stylesheet" href="/admin/css/min.css" />
        <script type="text/javascript" src="/admin/js/min.js"></script>
        
    </head>
    <body>
        
        <script type="text/javascript" src="/admin/content/settings/main.js"></script>
        <link rel="stylesheet" href="/admin/content/settings/style.css" />

  <div class="settings" id="settings">
        <div class="wrapper">
            <div class="grid3">
                <div class="titre">Backgrounds</div>
                <a href="url(/admin/css/img/bg.html" class="backgroundChanger active" title="White"></a>
                <a href="url(/admin/css/img/dark-bg.html" class="backgroundChanger dark" title="Dark"></a>
                <a href="url(/admin/css/img/wood.html" class="backgroundChanger dark" title="Wood"></a>
                <a href="url(/admin/css/img/altbg/smoothwall.html" class="backgroundChanger" title="Smoothwall"></a>
                <a href="url(/admin/css/img/altbg/black_denim.html" class="backgroundChanger dark" title="black_denim"></a>
                <a href="url(/admin/css/img/altbg/carbon.html" class="backgroundChanger dark" title="Carbon"></a>
                <a href="url(/admin/css/img/altbg/double_lined.html" class="backgroundChanger" title="Double lined"></a>
                <div class="clear"></div>
            </div>
            <div class="grid3">
                <div class="titre">Bloc style</div>
                <a href="black.html" class="blocChanger" title="Black" style="background:url(/admin/css/img/bloctitle.png);"></a>
                <a href="white.html" class="blocChanger active" title="White" style="background:url(/admin/css/img/white-title.png);"></a>
                <a href="wood.html" class="blocChanger" title="Wood" style="background:url(/admin/css/img/wood-title.jpg);"></a>
                <div class="clear"></div>
            </div>
            <div class="grid3">
                <div class="titre">Sidebar style</div>
                <a href="grey.html" class="sidebarChanger active" title="Grey" style="background:#494949"></a>
                <a href="black.html" class="sidebarChanger" title="Black" style="background:#262626"></a>
                <a href="white.html" class="sidebarChanger" title="White" style="background:#EEEEEE"></a>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
        <a class="settingbutton" href="#">

        </a>
    </div>        
        <!--              
                HEAD
                        --> 
        <div id="head">
            <div class="left">
                <a href="#" class="button profile"><img src="/admin/img/icons/top/huser.png" alt="" /></a>
                Hi, 
                <a href="#">修改密码</a>
                |
                <a href="#">退出</a>
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
                        <li><a href="/admin/user/create">添加用户</a></li>
                        <li><a href="/admin/user">浏览用户</a></li>
                       
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
           
        </div>
          
       
    </body>
</html>