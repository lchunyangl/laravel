<?php

namespace App\Http\Controllers;

use App\Common\Base;
use App\Models\Baoxiaolx;
use Illuminate\Http\Request;

class BaoxiaolxController extends Controller
{
    use Base;

    public $model;

    public function __construct(Baoxiaolx $model)
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
        $lists = $this->model->all();
        $query = $this->model;
        if ($id > 0) {
            $query = $query->where('baoxiaolx_id', $id);
        }
        $result                 = $query->Paginate($this->page_num_check());
        $this->assign['result'] = $result;
        $this->assign['lists']  = $lists;
        return view('baoxiaolx.index', $this->assign);
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
        $info                 = new $this->model;
        $info->bh             = trim($request->input('bh'));
        $info->baoxiaolx_name = trim($request->input('baoxiaolx_name'));
        $info->zjm            = trim($request->input('zjm'));
        $info->save();
        $html  = $this->build_html($info);
        $html1 = $this->build_html1($info);
        tips('新建成功', 0, ['html' => $html, 'html1' => $html1]);
    }

    protected function build_html($info)
    {
        $html = '<tr><td class="td_input"><input type="checkbox" value="' . $info->baoxiaolx_id . '"/></td>
                    <td>' . $info->baoxiaolx_id . '</td>
                    <td class="td_bianma">' . $info->bh . '</td>
                    <td class="td_xingming">' . $info->baoxiaolx_name . '</td>
                    <td class="td_zhujima">' . $info->zjm . '</td></tr>';
        return $html;
    }

    protected function build_html1($info)
    {
        $html = '<li onclick="info(' . $info->baoxiaolx_id . ')"><span class="t-tree-node-icon"></span><span class="last_ct">' . $info->baoxiaolx_name . '</span></li>';
        return $html;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $query = $this->model;
        if ($id > 0) {
            $query = $query->where('baoxiaolx_id', $id);
        }
        $result                 = $query->Paginate($this->page_num_check());
        $this->assign['result'] = $result;
        $html                   = response()->view('baoxiaolx.right', $this->assign)->getContent();
        tips('详情', 0, ['html' => $html]);
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
        $id = trim($id, ',');
        if (!empty($id)) {
            $id = explode(',', $id);
            $this->model->whereIn('baoxiaolx_id', $id)->delete();
            tips('删除成功');
        }
        tips('没有需要删除的信息', 1);
    }
}
