<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Admin\Type;

use DB;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $rs = Type::select(DB::raw('*,concat(path,tid) as paths'))->where('tname','like','%'.$request->tname.'%')->
        orderBy('paths','asc')->
        paginate($request->input('num',10));

        foreach($rs as $k => $v){
            //根据字符串重复的次数
            $info = substr_count($v->path, ',')-1;
            //改变分类名的样式
            $v->tname = str_repeat('|--', $info).$v->tname;
        }
        return view('admin.type.list',[
            'title'=>'分类的列表页面',
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
                //select *,concat(path,id) as paths from category ORDER BY paths asc
        //查询数据
        // $rs = type::all();
        //第一种方式
        // $rs = DB::select('select *,concat(path,tid) as paths from type ORDER BY paths asc');

         //查询构造器
        //第二种方式
        /*$rs = DB::table('category')->select(DB::raw('*,concat(path,id) as paths'))->
        orderBy('paths','asc')->
        get();*/
        // var_dump($rs);


        //模型方式
        //第三种方式
        $rs = Type::select(DB::raw('*,concat(path,tid) as paths'))->
        orderBy('paths','asc')->
        get();

        //第一种方式
       /* foreach($rs as $k => $v){
            //通过path路径
            $info = count(explode(',',$v->path))-2;

            $v->catename = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $info).$v->catename;

            // dump($info);
        }*/

        //第二种方式
        foreach($rs as $k => $v){
            //根据字符串重复的次数
            $info = substr_count($v->path, ',')-1;
            //改变分类名的样式
            $v->tname = str_repeat('|--', $info).$v->tname;
        }

        return view('admin.type.create',[
            'title'=>'分类的添加页面',
            'rs'=>$rs
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
         //dump($request->all());

        $rs = $request->except('_token');

        // 判断
        if($request->pid == '0'){

            $rs['path'] = '0,';
         } else {
            //根据pid进行查询数据
            $res = Type::where('tid',$request->pid)->first();

            //拼接path路径
            $rs['path'] = $res->path.$res->tid.',';

        }
        //添加数据
        //用户模型方式添加数据的时候返回的数据不是boolran也不是受影响行数
        //是一个数据的集合
        $data = Type::create($rs);
        if($data){
            return redirect('/admin/type')->with('success','添加成功');
        }else{
            return back()->with('error','添加失败');
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
        $rs = Type::find($id);
        // dump($rs);
        $res = Type::select(DB::raw('*,concat(path,tid) as paths'))->
        orderBy('paths','asc')->
        get();

        foreach($res as $k => $v){
            //根据字符串重复的次数
            $info = substr_count($v->path, ',')-1;
            //改变分类名的样式
            $v->tname = str_repeat('|--', $info).$v->tname;
        }

        //显示页面
        return view('admin.type.edit',[
            'title'=>'分类的修改页面',
            'rs'=>$rs,
            'res'=>$res
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
        // $data = $request->all();
        // dump($data);
        // 获取数据
        $rs = $request->except('_token','_method');

        $data = Type::where('tid',$id)->update($rs);

        if($data){

            return redirect('/admin/type')->with('success','修改成功');
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
        //根据id查询  你底下是否有其他的子分类
        $res = Type::where('tid', $id)->first();

        //如果有的话的就删除
        $rs = Type::where('path','like','%'.$res->path.$res->tid.',%')->delete();

        if(!$rs){

            echo '删除子类失败';
        }

        //删除完子分类的信息  就删除自己
        //如果查不到底下有其他的子分类  那么就直接删除自己
        $data = Type::destroy($id);

        //判断
        if($data){
            return redirect('/admin/type')->with('success','删除成功');
        } else {
            return back()->with('error','删除失败');
        }
    }

}
