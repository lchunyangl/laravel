<?php

namespace App\Http\Controllers;

use App\Common\Base;
use App\Models\Bumen;
use App\Models\Renyuan;
use Illuminate\Http\Request;

class RenyuanController extends Controller
{
    use Base;

    public $model;

    public function __construct(Renyuan $model)
    {
        $this->set($model);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Bumen $bumen)
    {
        $id    = intval($request->input('id'));
        $lists = $bumen->all();
        $query = $this->model;
        if ($id > 0) {
            $query = $query->where('bumen_id', $id);
        }
        $result                 = $query->Paginate($this->page_num_check());
        $this->assign['result'] = $result;
        $this->assign['lists']  = $lists;
        return view('renyuan.index', $this->assign);
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
        $info               = new $this->model;
        $info->bh           = trim($request->input('bh'));
        $info->renyuan_name = trim($request->input('renyuan_name'));
        $info->zjm          = trim($request->input('zjm'));
        $info->bumen_id     = intval($request->input('bumen_id'));
        $info->type         = intval($request->input('type'));
        $info->status       = intval($request->input('status'));
        $info->save();
        $info->load('bumen');
        $html = $this->build_html($info);
        tips('新建成功', 0, ['html' => $html]);
    }

    protected function build_html($info)
    {
        $html = '<tr id="' . $info->renyuan_id . '">
                            <td class="td_input">
                                <input type="checkbox" value="' . $info->renyuan_id . '"/>
                            </td>
                            <td>' . $info->renyuan_id . '</td>
                            <td class="td_bianma">' . $info->bh . '</td>
                            <td class="td_xingming">' . $info->renyuan_name . '</td>
                            <td class="td_bumen">' . $info->bumen->bumen_name . '</td>
                            <td class="td_shuxing">' . trans('models/renyuan.type')[$info->type] . '</td>
                            <td class="td_zhuangtai">' . trans('models/renyuan.status')[$info->status] . '</td>
                            <td class="td_zhujima">' . $info->bumen->zjm . '</td>
                        </tr>';
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
        $query = $this->model->with('bumen');
        if ($id > 0) {
            $query->where('bumen_id', $id);
        }
        $result                 = $query->Paginate($this->page_num_check());
        $this->assign['result'] = $result;
        $html                   = response()->view('renyuan.right', $this->assign)->getContent();
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
            $this->model->whereIn('renyuan_id', $id)->delete();
            tips('删除成功');
        }
        tips('没有需要删除的信息', 1);
    }
}
