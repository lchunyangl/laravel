<?php

namespace App\Http\Controllers;

use App\Common\Base;
use App\Models\Kemu;
use Illuminate\Http\Request;

class KemuController extends Controller
{
    use Base;

    public $model;

    public function __construct(Kemu $model)
    {
        $this->set($model);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id    = intval($request->input('id'));
        $lists = $this->model->with([
            'child' => function ($query) {
                $query->with([
                    'child' => function ($query) {
                        $query->with([
                            'child' => function ($query) {
                                $query->with([
                                    'child' => function ($query) {
                                        $query->with([
                                            'child' => function ($query) {
                                                $query->with([
                                                    'child' => function ($query) {
                                                        $query->with([
                                                            'child' => function ($query) {
                                                                $query->with('child');
                                                            }
                                                        ]);
                                                    }
                                                ]);
                                            }
                                        ]);
                                    }
                                ]);
                            }
                        ]);
                    }
                ]);
            }
        ])->get();
        $query = $this->model;
        if ($id > 0) {
            $query       = $query->where('kemu_id', $id);
            $parent      = $this->model->where('kemu_id', $id)->first();
            $parent_name = $parent->kemu_name;
            $parent_name = $this->get_parent_name($parent, $parent_name);
        } else {
            $parent_name = '会计科目';
        }
        $result                      = $query->Paginate($this->page_num_check());
        $this->assign['result']      = $result;
        $this->assign['lists']       = $lists;
        $this->assign['parent_name'] = $parent_name;
        return view('kemu.index', $this->assign);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $info            = new $this->model;
        $info->bh        = trim($request->input('bh'));
        $info->kemu_name = trim($request->input('kemu_name'));
        $info->zjm       = trim($request->input('zjm'));
        $info->parent_id = intval($request->input('parent_id'));
        if ($info->parent_id > 0) {
            $parent = $this->model->where('kemu_id', $info->parent_id)->first();
            if ($parent->level > 8) {
                tips('最多只能添加9级科目', 1);
            }
        }
        $info->save();
        if ($info->parent_id > 0) {
            $parent = $this->model->where('kemu_id', $info->parent_id)->first();
            if ($parent->level > 8) {
                tips('最多只能添加9级科目', 1);
            }
            $parent_name       = $parent->kemu_name;
            $parent_name       = $this->get_parent_name($parent, $parent_name);
            $info->parent_name = $parent_name;
        } else {
            $info->parent_name = '会计科目';
        }
        $html = response()->view('kemu.tr', ['v' => $info])->getContent();
        tips('新建成功', 0, ['html' => $html]);
    }

    private function get_parent_name($parent, $parent_name, $type = 0)
    {
        if ($parent->parent_id > 0) {
            $parent = $this->model->where('kemu_id', $parent->parent_id)->first();
            if ($type == 1) {
                $parent_name .= $parent->kemu_name;
            } else {
                $parent_name = $parent->kemu_name;
            }
            $this->get_parent_name($parent, $parent_name, $type);
        }
        return $parent_name;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
