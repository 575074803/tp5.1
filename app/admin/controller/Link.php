<?php
namespace app\admin\controller;
use think\Db;
use think\facade\Session;
use think\facade\Env;
class Link extends Common
{
    public function index()
    {
        $list=Db::name("link")->order('addtime desc')->paginate(15);
        $this->assign('list',$list);
        return $this->fetch();
    }

    public function add()
    {
        if (request()->isPost()){
            $data=input('post.');
            $data['addtime']=time();
            $res=Db::name('link')->insert($data);
            if($res){
                $result['info'] = '添加成功!';
                $result['status'] = 200;
                return $result;
            }else{
                $result['info'] = '添加失败!';
                $result['status'] = 400;
                return $result;
            }
        }else{

            return $this->fetch();
        }

    }

    public function edit()
    {
      if (request()->isPost()){
        $id=input('id');
        $data=input('post.');
        $res=Db::name('link')->where('id',$id)->update($data);
        if($res){
          $result['info'] = '修改成功!';
          $result['status'] = 200;
          $result['url'] =url('index');
          return $result;
        }else{
          $result['info'] = '修改失败!';
          $result['status'] = 400;
          return $result;
        }
      }else{
        $id=input('id');
        $list=Db::name('link')->where('id',$id)->find();
        $this->assign('list',$list);

        return $this->fetch();
      }
    }
}
