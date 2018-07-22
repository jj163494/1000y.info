<?php

namespace App\Admin\Controllers;

use App\Models\Account;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class UserController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('游戏账户管理');
            $content->description('');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('游戏账户管理');
            $content->description('谨慎修改');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('游戏账户管理');
            $content->description('');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Account::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->account('账号');
            $grid->telephone();
            $grid->char1('角色1');
            $grid->char2('角色2');
            $grid->char3('角色3');
            $grid->char4('角色4');
            $grid->char5('角色5');

            $grid->makedate();
            $grid->lastdate();
            //$grid->updated_at();

            $grid->model()->orderBy('id','asc');
            $grid->disableCreateButton();
            $grid->disableExport();
            $grid->actions(function ($actions) {
                $actions->disableDelete();
                //$actions->disableEdit();
            });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Account::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->display('account');
            $form->display('password');
            $form->mobile('telephone');
            $form->email('email');

            $form->text('char1');
            $form->text('char2');
            $form->text('char3');
            $form->text('char4');
            $form->text('char5');

            $form->display('makedate', 'Created At');
            $form->display('lastdate', 'Logined At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
