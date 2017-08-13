<table>
    <tr>
        <th class="qx">
            <input type="checkbox" name="qx" id="qx" value="" class="qx"/>
        </th>
        <th class="xh">序号</th>
        <th class="bm">类型编码</th>
        <th class="xm">类型名称</th>
        <th class="zjm">助记码</th>
    </tr>
    @foreach($result as $v)
        <tr id="{{$v->baoxiaolx_id}}">
            <td class="td_input">
                <input type="checkbox" value="{{$v->baoxiaolx_id}}"/>
            </td>
            <td>{{$v->baoxiaolx_id}}</td>
            <td class="td_bianma">{{$v->bh}}</td>
            <td class="td_xingming">{{$v->baoxiaolx_name}}</td>
            <td class="td_zhujima">{{$v->zjm}}</td>
        </tr>
    @endforeach
</table>
{{$result->links()}}