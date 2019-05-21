<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder; 
use Session;

use DB;
use Hash;
class LoginController extends Controller
{
    /**
     * 登录页面
     *
     * @return \Illuminate\Http\Response
     */
    public function login(){
    	return view('admin.login',['title'=>'后台的登录']);
    }

    /**
     * 处理登录的信息
     *
     * @return \Illuminate\Http\Response
     */
    public function dologin(Request $request)
    {
    	// dump($request->all());
    	//表单验证

    	//先获取用户名
    	$um = $request->username;

    	//根据用户名作对比
    	$rs = DB::table('admin')->where('username',$um)->first();

    	// var_dump($rs);

    	if(!$rs){

    		return back()->with('error','用户名或密码错误');
    	}

    	//对比密码
    	$pass = $rs->password;

    	if(!Hash::check($request->password,$pass)){

			return back()->with('error','用户名或密码错误');
    	}

    	//验证码
    	$code = session('code');
    	if($code != $request->code){

    		return back()->with('error','验证码错误');
    	}

    	//存储用户信息
    	session(['uid'=>$rs->id]);

    	return redirect('/admins')->with('success','登录成功');
    }

     /**
     * 验证码
     *
     * @return \Illuminate\Http\Response
     */
    public function captcha()
    {

        $phrase = new PhraseBuilder;
        //设置验证码位数
        $code = $phrase->build(4);
        //生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder($code, $phrase);
        //设置背景颜色
        $builder->setBackgroundColor(123, 203, 230);
        $builder->setMaxAngle(25);
        $builder->setMaxBehindLines(0);
        $builder->setMaxFrontLines(0);
        //可以设置图片宽高及字体
        $builder->build($width = 100, $height = 35, $font = null);
        // 获取验证码的内容
        $phrase = $builder->getPhrase();
        //把内容存入session
        session(['code'=> $phrase]);
        //生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header("Content-Type:image/jpeg");
        $builder->output();


    	/*//生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder;
        //可以设置图片宽高及字体
        $builder->build($width = 100, $height = 35, $font = null);
        //获取验证码的内容
        $phrase = $builder->getPhrase();
        //把内容存入session
        // Session::flash('milkcaptcha', $phrase);
        session(['code'=> $phrase]);
        //生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/jpeg');
        $builder->output();*/
    }

    /**
     * 显示修改头像
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
    	$rs = DB::table('admin')->where('id',session('uid'))->first();

    	return view('admin.profile',[
    		'title'=>'修改头像',
    		'rs'=>$rs
    	]);
    }

    /**
     * 处理头像
     *
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
    	$file = $request->file('file_upload');

    	//名字
        $name = 'img_'.rand(1111,9999).time();

        //获取后缀
        $suffix = $file->getClientOriginalExtension();

        $file->move('./uploads',$name.'.'.$suffix);

        echo '/uploads/'.$name.'.'.$suffix;

        //修改数据表里面的信息
        $rs['head'] = '/uploads/'.$name.'.'.$suffix;

        DB::table('admin')->where('id',session('uid'))->update($rs);



        //获取上传的文件对象
       /* $file = Input::file('file_upload');
        //判断文件是否有效
        if($file->isValid()){
            $entension = $file->getClientOriginalExtension();//上传文件的后缀名
            $newName = date('YmdHis').mt_rand(1000,9999).'.'.$entension;
            $path = $file->move(base_path().'/uploads',$newName);
            $filepath = 'uploads/'.$newName;
            //返回文件的路径
            return  $filepath;
        }*/


    }

    /**
     * 修改密码页面
     *
     * @return \Illuminate\Http\Response
     */
    public function pass()
    {
    	return view('admin.pass',['title'=>'修改密码']);
    }

    /**
     * 处理修改密码
     *
     * @return \Illuminate\Http\Response
     */
    public function dopass(Request $request)
    {
    	//验证

    	//获取旧密码
    	$pass = $request->oldpass;

    	//获取当前用户的信息
    	$rs = DB::table('admin')->where('id',session('uid'))->first();

    	//Hash
    	if(!Hash::check($pass,$rs->password )){

    		return back()->with('error','旧密码有误');
    	}

    	//两次密码一致
    	$res['password'] = Hash::make($request->password);

    	$data = DB::table('admin')->where('id',session('uid'))->update($res);

    	if($data){
    		//清空session
    		session(['uid'=>'']);

    		return redirect('/admin/logins');
    	} else {

    		return back();
    	}

    }

     /**
     * 退出
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
    	//清除session
    	session(['uid'=>'']);

    	//重定向
    	return redirect('/admin/logins')->with('success','退出成功');
    }

}
