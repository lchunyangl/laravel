<table>
    <tr>
        <th class="qx">
            <input type="checkbox" name="qx" id="qx" value="" class="qx"/>
        </th>
        <th class="xh">序号</th>
        <th class="bm">职员编码</th>
        <th class="xm">职员姓名</th>
        <th class="bmen">所属部门</th>
        <th class="sx">职员属性</th>
        <th class="zt">职员状态</th>
        <th class="zjm">助记码</th>
    </tr>
    @foreach($result as $v)
        <tr id="{{$v->renyuan_id}}">
            <td class="td_input">
                <input type="checkbox" value="{{$v->renyuan_id}}"/>
            </td>
            <td>1</td>
            <td class="td_bianma">{{$v->bh}}</td>
            <td class="td_xingming">{{$v->renyuan_name}}</td>
            <td class="td_bumen">{{$v->bumen->bumen_name or ''}}</td>
            <td class="td_shuxing">{{trans('models/renyuan.type')[$v->type]}}</td>
            <td class="td_zhuangtai">{{trans('models/renyuan.status')[$v->status]}}</td>
            <td class="td_zhujima">{{$v->zjm}}</td>
        </tr>
    @endforeach
</table>
{{$result->links()}}