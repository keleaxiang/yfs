<?php
//用户管理
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\WerRequest;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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


        //获取表单传过来的信息 返回的数据是一个数组
        $rs = $request->except('_token','repass','profile');

        //处理图片上传
        if($request->hasFile('profile')){

            //获取图片上传的信息
            $file = $request->file('profile');

            //名字
            $name = 'img_'.rand(1111,9999).time();

            //获取后缀
            $suffix = $file->getClientOriginalExtension();

            $file->move('./uploads',$name.'.'.$suffix);

            $rs['profile'] = '/uploads/'.$name.'.'.$suffix;

        }

        //密码的加密
        $rs['password'] = Hash::make($request->password);

       //存放数据库里面
        $data = User::create($rs);

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
