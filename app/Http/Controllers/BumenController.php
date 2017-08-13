<?php

namespace App\Http\Controllers;

use App\Common\Base;
use App\Models\Bumen;
use Illuminate\Http\Request;

class BumenController extends Controller
{
    use Base;

    public $model;

    public function __construct(Bumen $model)
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
            $query = $query->where('bumen_id', $id);
        }
        $result                 = $query->Paginate($this->page_num_check());
        $this->assign['result'] = $result;
        $this->assign['lists']  = $lists;
        return view('bumen.index', $this->assign);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bumen.create', $this->assign);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $info             = new $this->model;
        $info->bh         = trim($request->input('bh'));
        $info->bumen_name = trim($request->input('bumen_name'));
        $info->zjm        = trim($request->input('zjm'));
        $info->enabled    = intval($request->input('enabled'));
        $info->save();
        $html  = $this->build_html($info);
        $html1 = $this->build_html1($info);
        tips('新建成功', 0, ['html' => $html, 'html1' => $html1]);
    }

    protected function build_html($info)
    {
        $html = '<tr><td class="td_input"><input type="checkbox" value="' . $info->bumen_id . '"/></td>
                    <td>' . $info->bumen_id . '</td>
                    <td class="td_bianma">' . $info->bh . '</td>
                    <td class="td_xingming">' . $info->bumen_name . '</td>
                    <td class="td_shuxing">' . trans('models/bumen.enabled')[$info->enabled] . '</td>
                    <td class="td_zhujima">' . $info->zjm . '</td></tr>';
        return $html;
    }

    protected function build_html1($info)
    {
        $html = '<li onclick="info(' . $info->bumen_id . ')"><span class="t-tree-node-icon"></span><span class="last_ct">' . $info->bumen_name . '</span></li>';
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
            $query = $query->where('bumen_id', $id);
        }
        $result                 = $query->Paginate($this->page_num_check());
        $this->assign['result'] = $result;
        $html                   = response()->view('bumen.right', $this->assign)->getContent();
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
            $this->model->whereIn('bumen_id', $id)->delete();
            tips('删除成功');
        }
        tips('没有需要删除的信息', 1);
    }
}
