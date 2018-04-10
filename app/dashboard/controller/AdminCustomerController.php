<?php
/**
 * Created by PhpStorm.
 * User: afeng
 * Date: 18/4/10
 * Time: 上午9:46
 */

namespace app\dashboard\controller;


use app\dashboard\model\CustomerModel;
use cmf\controller\AdminBaseController;

/**
 * Class AdminCustomerController
 * @package app\dashboard\controller
 * @adminMenuRoot(
 *     'name'   =>'客户管理',
 *     'action' =>'default',
 *     'parent' =>'',
 *     'display'=> true,
 *     'order'  => 30,
 *     'icon'   =>'group',
 *     'remark' =>'客户管理'
 * )
 */

class AdminCustomerController extends AdminBaseController
{
    /**
     * 客户列表
     * @adminMenu(
     *     'name'   => '客户列表',
     *     'parent' => 'dashboard/AdminCustomer/default',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '客户列表',
     *     'param'  => ''
     * )
     */
    public function index(){
        $customerModel=new CustomerModel();
        $customer=$customerModel->where('delete_time',0)->order('id desc')->paginate(15);
        $this->assign('customer',$customer);
        $this->assign('page',$customer->render());
        return $this->fetch();
    }

    /**
     * 添加客户
     * @adminMenu(
     *     'name'   => '添加客户',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '添加客户',
     *     'param'  => ''
     * )
     */
    public function add(){
        return $this->fetch();
    }

    /**
     * 添加客户提交
     * @adminMenu(
     *     'name'   => '添加客户提交',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '添加客户提交',
     *     'param'  => ''
     * )
     */
    public function addPost(){
        $data=$this->request->param();
        $result=$this->validate($data,'Customer');
        if($result!==true){
            return $this->error($result);
        }
        $customerModel=new CustomerModel();
        $customerModel->AdminAddCustomer($data);
        $this->success('添加成功',url('AdminCustomer/index'));
    }

    /**
     * 编辑客户
     * @adminMenu(
     *     'name'   => '编辑客户',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '编辑客户',
     *     'param'  => ''
     * )
     */
    public function edit($id=0){
        $customerModel=new CustomerModel();
        $customer=$customerModel->get($id);
        $this->assign('customer',$customer);
        return $this->fetch();
    }

    /**
     * 编辑客户提交
     * @adminMenu(
     *     'name'   => '编辑客户提交',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '编辑客户提交',
     *     'param'  => ''
     * )
     */
    public function editPost(){
        $data=$this->request->param();
        $result=$this->validate($data,'Customer');
        if($result!==true){
            return $this->error($result);
        }
        $customerModel=new CustomerModel();
        $customerModel->AdminEditCustomer($data);
        $this->success('修改成功',url('AdminCustomer/index'));
    }

    /**
     * 删除客户
     * @adminMenu(
     *     'name'   => '删除客户',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '删除客户',
     *     'param'  => ''
     * )
     */
    public function delete($id=0){
        $customerModel=new CustomerModel();
        $result=$customerModel->save(['delete_time'=>time()],['id'=>$id]);
        if($result!==false){
            $this->success('删除成功');
        }else{
            $this->error('出错了,请重试');
        }
    }

    /**
     * 启用客户
     * @adminMenu(
     *     'name'   => '启用客户',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '启用客户',
     *     'param'  => ''
     * )
     */
    public function cancelban($id=0){
        $customerModel=new CustomerModel();
        $result=$customerModel->save(['user_status'=>1],['id'=>$id]);
        if($result!==false){
            $this->success('操作成功');
        }else{
            $this->error('出错了,请重试');
        }
    }

    /**
     * 禁用客户
     * @adminMenu(
     *     'name'   => '禁用客户',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '禁用客户',
     *     'param'  => ''
     * )
     */
    public function ban($id=0){
        $customerModel=new CustomerModel();
        $result=$customerModel->save(['user_status'=>0],['id'=>$id]);
        if($result!==false){
            $this->success('操作成功');
        }else{
            $this->error('出错了,请重试');
        }
    }


}