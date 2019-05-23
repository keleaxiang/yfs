<?php
//用户管理
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\WerRequest;
use App\Model\Admin\User;
use Hash;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         //获取传过来的数据
       /* $um = $_GET['num'];
        $se = $_GET['search'];

        // dd($um, $se);
        dump($um, $se);*/

        // $num = $request->num;

        // $search = $request->search;

        //获取数据
        //单个条件的搜索
        // $rs = User::where('username','like','%'.$search.'%')->paginate($request->input('num',10));

        //多个条件的搜索
        $rs = User::orderBy('id','asc')

            ->where(function($query) use($request){
                //检测关键字
                $username = $request->input('username');
                $email = $request->input('email');
                //如果用户名不为空
                if(!empty($username)) {
                    $query->where('username','like','%'.$username.'%');
                }
                //如果邮箱不为空
                if(!empty($email)) {
                    $query->where('email','like','%'.$email.'%');
                }
            })
            ->paginate($request->input('num', 10));


        //显示一个列表页
        return view('admin.user.list',[
            'title'=>'用户的列表页面',
            'rs'=>$rs,
            'request'=>$request

        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create',[
            'title'=>'后台的用户添加页面',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WerRequest $request)
    {
        //表单验证
       
        // $this->validate($request, [
        //     'username' => 'required|regex:/^\w{6,12}$/',
        //     'password' => 'required|regex:/^\S{8,16}$/',
        //     'repass'=>'same:password',
        //     'email'=> 'email',
        //     'phone'=>'required|regex:/^1[3456789]\d{9}$/'
            
        // ],[
        //     'username.required' => '用户名不能为空',
        //     'username.regex' => '用户名格式不正确',
        //     'username.unique' => '用户名已经存在',
        //     'password.required'=>'密码不能为空',
        //     'password.regex'=>'密码格式不正确',
        //     // 'repass.required'=>'确认密码不能为空',
        //     'repass.same'=>'两次密码不一致',
        //     'email.email'=>'邮箱格式不正确',
        //     'phone.required'=>'手机号码不能为空',
        //     'phone.regex'=>'手机号码格式不正确',
        // ]);

            // $rs = $request->all();
            // dump($rs);
        //获取表单传过来的信息 返回的数据是一个数组
        $rs = $request->except('_token','repass','head');
        //处理图片上传
        if($request->hasFile('head')){

            //获取图片上传的信息
            $file = $request->file('head');

            //名字
            $name = 'img_'.rand(1111,9999).time();

            //获取后缀
            $suffix = $file->getClientOriginalExtension();

            $file->move('./uploads',$name.'.'.$suffix);

            $rs['head'] = '/uploads/'.$name.'.'.$suffix;

        }

        //密码的加密
        $rs['password'] = Hash::make($request->password);

       //存放数据库里面
        $data = User::create($rs);
        // dump($data);
        if($data){

            return redirect('admin/user');

        } else {

            return back();

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //根据id获取数据
        $rs = User::find($id);
        //显示页面
        return view('admin.user.edit',[
            'title'=>'用户的修改页面',
            'rs'=>$rs
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //表单验证

        //删除头像
        //通过id获取头像的路径数据

        //通过unlink('.'.路径)删除


        //获取数据
        $rs = $request->except('_token','_method');

        //处理头像
        if($request->hasFile('head')){

            //获取图片上传的信息
            $file = $request->file('head');

            //名字
            $name = 'img_'.rand(1111,9999).time();

            //获取后缀
            $suffix = $file->getClientOriginalExtension();

            $file->move('./uploads',$name.'.'.$suffix);

            $rs['head'] = '/uploads/'.$name.'.'.$suffix;

        }

        //修改数据
        $data = User::where('id',$id)->update($rs);

        if($data){

            return redirect('/admin/user')->with('success','修改成功');
        } else {

            return back()->with('error','修改失败');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //根据id获取路径信息

        //unlink()    返回的boolean

        //根据id删除数据
        $data = User::destroy($id);

        if($data){

            return redirect('/admin/user')->with('success','删除成功');
        } else {

            return back()->with('error','删除失败');

        }
    }
}
