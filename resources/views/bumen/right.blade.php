<table>
    <tr>
        <th class="qx">
            <input type="checkbox" name="qx" id="qx" value="" class="qx"/>
        </th>
        <th class="xh">序号</th>
        <th class="bm">部门编码</th>
        <th class="xm">部门名称</th>
        <th class="sx">停用</th>
        <th class="zjm">助记码</th>
    </tr>
    @foreach($result as $v)
        <tr id="{{$v->bumen_id}}">
            <td class="td_input">
                <input type="checkbox" value="{{$v->bumen_id}}"/>
            </td>
            <td>{{$v->bumen_id}}</td>
            <td class="td_bianma">{{$v->bh}}</td>
            <td class="td_xingming">{{$v->bumen_name}}</td>
            <td class="td_shuxing">{{trans('models/bumen.enabled')[$v->enabled]}}</td>
            <td class="td_zhujima">{{$v->zjm}}</td>
        </tr>
    @endforeach
</table>
{{$result->links()}}