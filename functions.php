<?php
/**
 * Created by PhpStorm.
 * User: 'chunyang'
 * Date: 2016/12/20
 * Time: 14:06
 */

use App\Models\Menu;
use Illuminate\Support\Facades\Cache;
use App\Models\RoleUser;


if (!function_exists('success_msg')) {

    /**
     * @param string $msg
     * @param string $link
     * @param string $text
     */
    function success_msg($msg = '您请求的页面不存在', $link = [], $view = 'msg', $re_url = '')
    {
        $links = links($link);
        $a     = response()->view("common." . $view, ['success' => 1, 'msg' => $msg, 'links' => $links, 're_url' => $re_url]);
        exit($a->getContent());
    }
}
if (!function_exists('error_msg')) {

    /**
     * @param string $msg
     * @param string $link
     * @param string $text
     */
    function error_msg($msg = '您请求的页面不存在', $link = [], $view = 'msg', $re_url = '')
    {
        $links = links($link);
        $a     = response()->view("common." . $view, ['success' => 0, 'msg' => $msg, 'links' => $links, 're_url' => $re_url]);
        exit($a->getContent());
    }
}

if (!function_exists('path')) {


    function path($path, $secure = null)
    {
        return app('url')->asset($path, $secure) . '?20170703';
    }
}

if (!function_exists('get_region_name')) {

    function get_region_name($region_ids, $fuhao = '')
    {
        $name        = '';
        $region_name = \DB::table('region')->select('region_name')->whereIn('region_id', $region_ids)->get();
        foreach ($region_name as $v) {
            $name .= $v->region_name . $fuhao;
        }
        return $name;
    }
}
function get_img_path($img)
{
    $http = "http://images.hezongyy.com/";
    return $http . $img;
}

function get_img_path_ht($img)
{
    $http = "http://yyadmin.hezongyy.com/";
    return $http . $img;
}

function get_region($parent_id)
{

    $region = Cache::tags(['houtai', 'region1'])->remember($parent_id, 7 * 24 * 360, function () use ($parent_id) {
        $result = \App\Models\Region::select('region_id', 'region_name')->where('parent_id', $parent_id)->get();
        return $result;
    });
//    $region = \App\Models\Region::where('parent_id',$parent_id)->get();
    return $region;
}

if (!function_exists('memberInfo')) {

    function memberInfo($user_id)
    {

        $memberInfo = Cache::tags(['houtai', 'memberInfo'])->remember($user_id, 10, function () use ($user_id) {

            $memberInfo = \App\Models\Member::find($user_id);
            return $memberInfo;
        });
        return $memberInfo;
    }
}

if (!function_exists('get_menu')) {


    /**
     * @param $url
     * @param $text
     * @return string
     */
    function get_menu($where = '', $type = 0)
    {
//        $menu      = Cache::tags(['houtai'])->rememberForever('menu', function () {
//            $result = Menu::with([
//                'child' => function ($query) {
//                    $query->with('role_menu');
//                },
//                'role_menu'
//            ])->where('parent_id', 0)->orderBy('order')->get();
//            return $result;
//        });
        $menu = Menu::with([
            'child' => function ($query) {
                $query->with('role_menu')->orderBy('order')->orderBy('id');
            },
            'role_menu'
        ]);
        if ($where instanceof \Closure) {
            $menu->where($where);
        } else {
            $menu->where('parent_id', 0);
        }
        $menu      = $menu->orderBy('order')->orderBy('id')->get();
        $user      = session_admin();
        $role_user = $user->role->pluck('id')->toArray();
        foreach ($menu as $k => $v) {
            $has = 0;
            if (count($v->role_menu) > 0) {
                $role_ids = $v->role_menu->pluck('role_id');
                $jiaoji   = $role_ids->intersect($role_user);
                if (count($jiaoji) == 0) {
                    if ($type == 1) {
                        unset($menu[$k]);
                    }
                } else {
                    $has++;
                }
            } else {
                $has++;
            }
            if (count($v->child) > 0) {
                foreach ($v->child as $key => $val) {
                    if (count($val->role_menu) > 0) {
                        $role_ids = $val->role_menu->pluck('role_id');
                        $jiaoji   = $role_ids->intersect($role_user);
                        if (count($jiaoji) == 0) {
                            unset($v->child[$key]);
                        } else {
                            $has++;
                        }
                    }
                }
            } else {
                $has++;
            }
            if ($has == 0) {
                unset($menu[$k]);
            }
        }
        return $menu;
    }
}

if (!function_exists('session_admin')) {

    function session_admin()
    {
        $user = auth()->user();
        if (!$user) {
            $user = \App\User::find(1);
        }
        $new_user   = Cache::tags(['houtai', 'user_info'])->remember($user->user_id, 60 * 24, function () use ($user) {
            $user->load([
                'role' => function ($query) {
                    $query->with(['permission', 'menu']);
                },
            ]);
            return $user;
        });
        $permission = [];
        $role       = [];
        foreach ($new_user->role as $v) {
            if ($v->name == 'administrator') {
                $new_user->is_admin = 1;
            }
            $role[]         = $v->name;
            $permission_arr = $v->permission->pluck('name')->toArray();
            $permission     = array_merge($permission, $permission_arr);
        }
        $new_user->all_permission = $permission;
        $new_user->all_role       = $role;
        //$user = session($cookie);
        return $new_user;
    }
}

if (!function_exists('links')) {
    function links($list = [])
    {
        $links = '';
        if (count($list) > 0) {
            foreach ($list as $k => $v) {
                $links .= '<span style="margin: 0 10px;">|</span><a href="' . $k . '" class="c-primary">' . $v . '</a>';
            }
        }
        return $links;
    }
}

if (!function_exists('check_role')) {
    function check_role($role, $flag = false)
    {
        $user = session_admin();
        if (!is_array($role)) {
            $role = [$role];
        }
        if ($flag == true) {
            $status = 1;//有权限
        } else {
            $status = 0;//没权限
        }
        foreach ($role as $v) {
            if ($flag == true) {//都要满足
                if (!in_array($v, $user->all_role)) {
                    $status = 0;
                }
            } else {//满足其一
                if (in_array($v, $user->all_role)) {
                    $status = 1;
                }
            }
        }
        if ($status == 0) {
            if (\Illuminate\Support\Facades\Request::ajax()) {
                ajax_return('没有权限', 1);
            } else {
                error_msg('没有权限');
            }
        }
    }
}

if (!function_exists('check_permission')) {
    function check_permission($permission, $flag = false)
    {
        $permission_check = env('PERMISSION_CHECK', true);
        if ($permission_check == false) {
            $info = \App\Models\Permission::where('name', $permission)->first();
            if (!$info) {
                return true;
            }
        }
        $user = session_admin();
        if (!is_array($permission)) {
            $permission = [$permission];
        }
        if ($flag == true) {
            $status = 1;//有权限
        } else {
            $status = 0;//没权限
        }
        foreach ($permission as $v) {
            if ($flag == true) {//都要满足
                if (!in_array($v, $user->all_permission)) {
                    $status = 0;
                }
            } else {//满足其一
                if (in_array($v, $user->all_permission)) {
                    $status = 1;
                }
            }
        }
        if ($status == 0) {
            if (\Illuminate\Support\Facades\Request::ajax()) {
                ajax_return('没有权限', 1);
            } else {
                error_msg('没有权限');
            }
        }
    }
}

if (!function_exists('has_permission')) {
    function has_permission($permission, $flag = false)
    {
        $user = session_admin();
        if (!is_array($permission)) {
            $permission = [$permission];
        }
        if ($flag == true) {
            $status = 1;//有权限
        } else {
            $status = 0;//没权限
        }
        foreach ($permission as $v) {
            if ($flag == true) {//都要满足
                if (!in_array($v, $user->all_permission)) {
                    $status = 0;
                }
            } else {//满足其一
                if (in_array($v, $user->all_permission)) {
                    $status = 1;
                }
            }
        }

        return $status;
    }
}

if (!function_exists('has_role')) {
    function has_role($role, $flag = false)
    {
        $user = session_admin();
        if (!is_array($role)) {
            $role = [$role];
        }
        if ($flag == true) {
            $status = 1;//有权限
        } else {
            $status = 0;//没权限
        }
        foreach ($role as $v) {
            if ($flag == true) {//都要满足
                if (!in_array($v, $user->all_role)) {
                    $status = 0;
                }
            } else {//满足其一
                if (in_array($v, $user->all_role)) {
                    $status = 1;
                }
            }
        }
        return $status;
    }
}

if (!function_exists('yes_no_img')) {
    function yes_no_img($id)
    {
        $imgs = [
            '0' => path('images/no.gif'),
            '1' => path('images/yes.gif'),
            '2' => path('images/redyes.gif'),
        ];
        if (isset($imgs[$id])) {
            return $imgs[$id];
        }
        error_msg('图片不存在');
    }
}

if (!function_exists('no_yes_img')) {
    function no_yes_img($id)
    {
        $imgs = [
            '0' => path('images/yes.gif'),
            '1' => path('images/no.gif'),
            '2' => path('images/redyes.gif'),
        ];
        if (isset($imgs[$id])) {
            return $imgs[$id];
        }
        error_msg('图片不存在');
    }
}

if (!function_exists('edit_handle')) {
    function edit_handle($url, $title = '编辑', $type = 0, $permission = '', $icon = 'edit.png')
    {
//        if (!empty($permission)) {
//            if (!has_permission($permission)) {
//                return '';
//            }
//        }
        switch ($type) {
            case 0:
                $btn = '<a title="' . $title . '" href="javascript:;" onclick="create_b(\'' . $url . '\',\'' . $title . '\')" style="text-decoration:none"><img src="' . path('icons/' . $icon) . '"/></a>';
                break;
            case 1:
                $btn = '<a title="' . $title . '" href="javascript:;" onclick="create_a(\'' . $url . '\',\'' . $title . '\')" style="text-decoration:none"><img src="' . path('icons/' . $icon) . '"/></a>';
                break;
            case 2:
                $btn = '<a title="' . $title . '" target="_blank" href="' . $url . '" style="text-decoration:none"><img src="' . path('icons/' . $icon) . '"/></a>';
                break;
            default:
                $btn = '<a title="' . $title . '" href="javascript:;" onclick="create_b(\'' . $url . '\',\'' . $title . '\')" style="text-decoration:none"><img src="' . path('icons/' . $icon) . '"/></a>';
        }
        return $btn;
    }
}

if (!function_exists('delete_handle')) {
    function delete_handle($url, $text = '删除', $icon = 'delete', $method = 'delete', $permission = '')
    {
//        if (!empty($permission)) {
//            if (!has_permission($permission)) {
//                return '';
//            }
//        }
        $btn = '<a method="' . $method . '" title="' . $text . '" href="javascript:;" onclick="delete_cz(this,\'' . $url . '\')" style="text-decoration:none"><img src="' . path('icons/' . $icon . '.png') . '"/></a>';
        return $btn;
    }
}

if (!function_exists('check_handle')) {
    function check_handle($url, $text = '查看', $icon = 'check', $permission = '')
    {
//        if (!empty($permission)) {
//            if (!has_permission($permission)) {
//                return '';
//            }
//        }
        $btn = '<a title="' . $text . '" data-href="' . $url . '" data-title="' . $text . '" onclick="Hui_admin_tab($(this))"><img src="' . path('icons/' . $icon . '.png') . '"/></a>';
        return $btn;
    }
}

if (!function_exists('show_area_list')) {
    function show_area_list($key = '*')
    {
        $show_arr_list = [
            'b'  => '呼吸系统用药',
            'c'  => '清热、消炎',
            'd'  => '五官、皮肤及外用',
            'e'  => '消化、肝胆系统',
            'f'  => '补益安神及维矿类 ',
            'g'  => '妇、儿科 ',
            'h'  => '心脑血管及神经类用药',
            'i'  => '内分泌系统（含糖尿病）',
            'j'  => '风湿骨伤及其他药品',
            'k'  => '特殊复方制剂、生物制品',
            'm'  => '非药品',
            'n'  => '丽珠集团四川光大控销产品',
            'o'  => '九州通控销事业二部控销产品',
            'p'  => '石药集团大健康事业部控销产品',
            '11' => '普药',
            '2'  => '精品专区',
            '4'  => '中药饮片',
            '7'  => '效期专区',
            'a'  => '控销专区',
        ];
        if ($key != '*' && !is_null($key)) {
            foreach ($show_arr_list as $k => $v) {
                if (!in_array($k, $key)) {
                    unset($show_arr_list[$k]);
                }
            }
        }
        return $show_arr_list;
    }
}

if (!function_exists('user_rank')) {
    function user_rank($key = '*')
    {
        $user_rank = Cache::tags(['houtai'])->rememberForever('user_rank', function () {
            $result = \App\Models\UserRank::pluck('rank_name', 'rank_id');
            return $result;
        });
        $user_rank->prepend('非特殊等级', 0);
        if ($key != '*' && !is_null($key)) {
            foreach ($user_rank as $k => $v) {
                if (!in_array($k, $key)) {
                    unset($user_rank[$k]);
                }
            }
        }
        return $user_rank;
    }
}

if (!function_exists('goods_search_options')) {
    function goods_search_options()
    {
        $options = [
            1  => '查询哈药码上有商品',
            2  => '查询价格差异商品',
            3  => '查询价格(负)差异商品',
            4  => '查询有优惠金额商品',
            5  => '查询有价格有库存无图片商品',
            6  => '查询有价格有库存无说明书商品',
            7  => '查询有价格有库存无分类书商品',
            8  => '查询有价格有库存有图片商品',
            9  => '查询新人特价商品',
            10 => '查询有特殊标识商品',
            11 => '查询效期3个月内商品',
            12 => '查询效期3-6个月内商品',
            13 => '查询特价预览商品',
            14 => '查询特价商品',
            15 => '查询签约会员商品',
            16 => '查询非时间段限购',
            17 => '未分配到中药的商品',
        ];
        return $options;
    }
}

if (!function_exists('member_search_type')) {
    function member_search_type()
    {
        $options = [
//            1=>'查询专属客户',
            2 => '查询购买过的客户',
            3 => '查询未买过的客户',
            4 => '查询已停用的会员账号',
            5 => '查询有优惠券的会员账号',
            6 => '查询无优惠券的会员账号',
            7 => '查询签约会员账号',
        ];
        return $options;
    }
}
if (!function_exists('member_search_gly')) {
    function member_search_gly()
    {
        $options = [
            1 => '未指派管理员',
        ];
        return $options;
    }
}

if (!function_exists('admin_log')) {
    function admin_log($sn)
    {
        $user                  = session_admin();
        $admin_log             = new \App\Models\AdminLog();
        $admin_log->user_id    = $user->user_id;
        $admin_log->log_info   = $sn;
        $admin_log->log_time   = time();
        $admin_log->ip_address = \Illuminate\Support\Facades\Request::ip();
        $admin_log->save();

    }
}

if (!function_exists('get_region_list')) {
    function get_region_list($pid = 1, $id = 0)
    {
        if ($id > 0 || is_array($id)) {
            if (is_array($id)) {
                $result = \App\Models\Region::whereIn('region_id', $id);
            } else {
                $result = \App\Models\Region::where('region_id', $id);
            }
        } else {
            $result = \App\Models\Region::where('parent_id', $pid);
        }
        $result = $result->orderBy('agency_id', 'desc')->orderBy('region_id')->pluck('region_name', 'region_id');
        return $result;
    }
}

/*
 * 格式化价格
 * @price 价格
 */
if (!function_exists('price_formats')) {
    function price_formats($price)
    {
        return '￥' . sprintf('%.2f', abs($price));
    }
}
if (!function_exists('real_price_formats')) {
    function real_price_formats($price)
    {
        return '￥' . sprintf('%.2f', $price);
    }
}
if (!function_exists('mkdirs')) {
    function mkdirs($dir, $mode = 0777)
    {
        if (is_dir($dir) || @mkdir($dir, $mode)) return TRUE;
        if (!mkdirs(dirname($dir), $mode)) return FALSE;
        return @mkdir($dir, $mode);
    }
}

if (!function_exists('os')) {
    function os($os, $style = 0)
    {
        $arr = [
            0 => '未确认',
            1 => '已确认',
            2 => '已取消',
        ];
        if ($style == 1) {
            $arr[2] = '<span style="color: red;">已取消</span>';
        }
        if (isset($arr[$os])) {
            return $arr[$os];
        } else {
            return '未知状态';
        }
    }
}
if (!function_exists('ps')) {
    function ps($ps, $style = 0)
    {
        $arr = [
            0 => '未付款',
            1 => '付款中',
            2 => '已付款',
        ];
        if ($style == 1) {
            $arr[2] = '<span style="color: red;">已付款</span>';
        }
        if (isset($arr[$ps])) {
            return $arr[$ps];
        } else {
            return '未知状态';
        }
    }
}
if (!function_exists('ss')) {
    function ss($ss, $type = 0)
    {
        if ($type == 0) {
            $arr = [
                0 => '未开票',
                1 => '已开票',
                2 => '出库中',
                3 => '已出库',
                4 => '已发货',
                5 => '已完成',
            ];
        } else {
            $arr = [
                0 => '未开票',
                1 => '<span style="color: green">已开票</span>',
                2 => '出库中',
                3 => '<span style="color: blue">已出库</span>',
                4 => '<span style="color: red">已发货</span>',
                5 => '已完成',
            ];
        }
        if (isset($arr[$ss])) {
            return $arr[$ss];
        } else {
            return '未知状态';
        }
    }
}
if (!function_exists('dzfp')) {
    function dzfp($dzfp)
    {
        $arr = [
            0 => '增值税普通发票',
            1 => '纸制发票',
            2 => '增值税专用发票',
        ];
        if (isset($arr[$dzfp])) {
            return $arr[$dzfp];
        } else {
            return '未知发票';
        }
    }
}
if (!function_exists('zp_area')) {
    function zp_area()
    {
        $arr = [
            '都江堰' => '都江堰',
            '邛崃'  => '邛崃',
            '金堂'  => '金堂',
            '双流'  => '双流',
            '简阳'  => '简阳',
            '郫县'  => '郫县',
            '新津'  => '新津',
            '仁寿'  => '仁寿',
            '新都'  => '新都',
            '彭州'  => '彭州',
            '什邡'  => '什邡',
            '绵阳'  => '绵阳',
            '德阳'  => '德阳',
            '温江'  => '温江',
            '青白江' => '青白江',
        ];
        return $arr;
    }
}

if (!function_exists('get_user_info')) {
    function get_user_info($id)
    {
        $info = \App\Models\User::find($id);
        if (empty($info)) {
            error_msg('会员不存在');
        }
        $info = $info->is_zhongduan();
        return $info;
    }
}

if (!function_exists('get_order_info')) {
    function get_order_info($id, $goods = -1)
    {
        $info = \App\Models\OrderInfo::find($id);
        if (empty($info)) {
            $info = \App\Models\OldOrderInfo::find($id);
        }
        if (empty($info)) {
            error_msg('订单不存在');
        }
        if ($goods != -1) {
            if ($goods == 0) {
                $info->load('order_goods');
            } elseif ($goods > 0) {
                $info->load([
                    'order_goods' => function ($query) use ($goods) {
                        $query->where('goods_id', $goods);
                    }
                ]);
            }
        }
        return $info;
    }
}

if (!function_exists('get_tags')) {
    function get_tags($arr, $name = '')
    {
        if (!empty($name)) {
            foreach ($arr as $k => $v) {
                if ($v['name'] != $name) {
                    unset($arr[$k]);
                }
            }
        }
        return $arr;
    }
}

if (!function_exists('order_amount')) {
    function order_amount($order, $column = [])
    {
        $arr          = [
            'goods_amount' => 1,
            'shipping_fee' => 1,
            'discount'     => -1,
            'zyzk'         => -1,
            'pack_fee'     => -1,
            'surplus'      => -1,
            'money_paid'   => -1,
            'jnmj'         => -1,
        ];
        $order_amount = 0;
        foreach ($arr as $k => $v) {
            if (isset($column[$k])) {
                $order_amount += $column[$k] * $v;
            } else {
                $order_amount += $order->$k * $v;
            }
        }
        if (abs($order_amount) < 0.000001) {
            $order_amount = 0;
        }
        return $order_amount;
    }
}
if (!function_exists('order_cost')) {
    function order_cost($order, $column, $order_amount)
    {
        $arr     = [
            'goods_amount' => 1,
            'shipping_fee' => 1,
            'order_amount' => -1,
            'discount'     => -1,
            'zyzk'         => -1,
            'pack_fee'     => -1,
            'surplus'      => -1,
            'money_paid'   => -1,
            'jnmj'         => -1,
        ];
        $$column = 0;
        foreach ($arr as $k => $v) {
            if ($k == 'order_amount') {
                $$column += $order_amount * $v;
            } elseif ($column != $k) {
                $$column += $order->$k * $v;
            }
        }
        return $$column;
    }
}

if (!function_exists('ajax_return')) {
    function ajax_return($msg, $error = 0, $params = [])
    {
        $result = [
            'error' => $error,
            'msg'   => $msg,
        ];
        $result = array_merge($result, $params);
        exit(response()->json($result)->getContent());
    }
}

if (!function_exists('union_log')) {
    function union_log($inputs, $info, $change_desc, $change_count, $name)
    {
        $trans_models = trans_models();
        foreach ($inputs as $k => $v) {
            if ((isset($info->$k)) && !is_array($v)) {
                if ($info->$k instanceof \Carbon\Carbon) {
                    if (empty($v)) {
                        $v = 0;
                        $v = \Carbon\Carbon::createFromTimestamp($v);
                    } else {
                        $v = \Carbon\Carbon::parse($v);
                    }
                    if ($info->$k->ne($v)) {
                        $column = trans($trans_models . $name . '.' . $k);
                        if (isset($column['log']) && $column['log'] == 1) {
                            $change_desc[] = $column['info'] . '由:' . $info->$k . ",改成:" . $v;
                        }
                        $info->$k = $v;
                        $change_count++;
                    }
                } else {
                    $info->$k = trim($info->$k);
                    $v        = trim($v);
                    if ($info->$k != $v) {
                        $column = trans($trans_models . $name . '.' . $k);
                        if (isset($column['log']) && $column['log'] == 1) {
                            $change_desc[] = $column['info'] . '由:' . $info->$k . ",改成:" . $v;
                        }
                        $info->$k = $v;
                        $change_count++;
                    }
                }
            } elseif (is_array($v)) {
                if (is_array($info->$k)) {
                    $delete = array_diff($info->$k, $v);
                    $create = array_diff($v, $info->$k);
                    if (count($delete) > 0) {
                        $column = trans($trans_models . $name . '.' . $k);
                        if (isset($column['log']) && $column['log'] == 1) {
                            $change_desc[] = $column['info'] . '删除了:' . implode(',', $delete);
                        }
                        $info->$k = $v;
                        $change_count++;
                    }
                    if (count($create) > 0) {
                        $column = trans($trans_models . $name . '.' . $k);
                        if (isset($column['log']) && $column['log'] == 1) {
                            $change_desc[] = $column['info'] . '新增了:' . implode(',', $create);
                        }
                        $info->$k = $v;
                        $change_count++;
                    }
                } else {
                    $change_desc[$k] = [];
                    $result          = union_log($inputs[$k], $info->$k, $change_desc[$k], $change_count, $k);
                    $info->$k        = $result['info'];
                    $change_desc[$k] = $result['change_desc'];
                    $change_count    = $result['change_count'];
                }
            }
        }

        return [
            'info'         => $info,
            'change_count' => $change_count,
            'change_desc'  => $change_desc,
        ];
    }
}

if (!function_exists('trans_models')) {
    function trans_models()
    {
        return 'models/';
    }
}

if (!function_exists('log_account_change')) {
    function log_account_change($user, $user_money = 0, $frozen_money = 0, $rank_points = 0, $pay_points = 0, $change_desc = '', $change_type = 99, $money_type = 0, $order_id = 0)
    {
        $account_log               = new \App\Models\AccountLog();
        $account_log->user_id      = $user->user_id;
        $account_log->user_money   = $user_money;
        $account_log->frozen_money = $frozen_money;
        $account_log->rank_points  = $rank_points;
        $account_log->pay_points   = $pay_points;
        $account_log->change_desc  = $change_desc;
        $account_log->change_type  = $change_type;
        $account_log->money_type   = $money_type;
        $account_log->order_id     = $order_id;
        \Illuminate\Support\Facades\DB::transaction(function () use ($account_log, $user) {
            /* 插入帐户变动记录 */
            $account_log->save();
            /* 更新用户信息 */
            $user->user_money   = $user->user_money + $account_log->user_money;
            $user->frozen_money = $user->frozen_money + $account_log->frozen_money;
            $user->rank_points  = $user->rank_points + $account_log->rank_points;
            $user->pay_points   = $user->pay_points + $account_log->pay_points;
            $user->save();
        });
    }

}

if (!function_exists('log_jnmj_change')) {
    function log_jnmj_change($user_jnmj, $jnmj_money = 0, $change_desc = '')
    {
        $jnmj_log              = new \App\Models\JnmjLog();
        $jnmj_log->user_id     = $user_jnmj->user_id;
        $jnmj_log->jnmj_money  = $jnmj_money;
        $jnmj_log->change_desc = $change_desc;
        $jnmj_log->save();
        $user_jnmj->jnmj_amount = $user_jnmj->jnmj_amount + $jnmj_money;
        $user_jnmj->save();
    }
}

if (!function_exists('log_zq_change')) {
    function log_zq_change($zq_type, $zq_info, $change_je, $change_amount, $change_desc, $change_type = 0)
    {
        /* 插入帐户变动记录 */
        if ($zq_type == 1) {
            $zq_log = new \App\Models\Zq\ZqLog();
        } elseif ($zq_type == 2) {
            $zq_log = new \App\Models\ZqYwy\ZqLog();
        } elseif ($zq_type == 3) {
            $zq_log = new \App\Models\ZqSy\ZqLog();
        } else {
            error_msg('账期信息不存在');
        }
        $zq_log->user_id       = $zq_info->user_id;
        $zq_log->change_amount = $change_amount;
        $zq_log->change_je     = $change_je;
        $zq_log->change_desc   = $change_desc;
        $zq_log->change_type   = $change_type;
        $zq_log->save();


        $zq_info->zq_je     = $zq_info->zq_je + $change_je;
        $zq_info->zq_amount = $zq_info->zq_amount + $change_amount;
        if ($zq_info->zq_amount == 0 && $zq_info->zq_has == 1) {//账期结清
            $zq_info->zq_has = 0;
        }
        $zq_info->save();
    }
}

if (!function_exists('order_action')) {
    function order_action($order, $action_note = '')
    {
        $user                          = session_admin();
        $order_action                  = new \App\Models\OrderAction();
        $order_action->order_id        = $order->order_id;
        $order_action->action_user     = $user->name;
        $order_action->order_status    = $order->order_status;
        $order_action->shipping_status = $order->shipping_status;
        $order_action->pay_status      = $order->pay_status;
        $order_action->action_note     = $action_note;
        $order_action->log_time        = time();
        $order_action->save();
    }

}

if (!function_exists('order_action_fhd')) {
    function order_action_fhd($id, $order, $action_note = '')
    {
        $user                          = session_admin();
        $order_action                  = new \App\Models\OrderAction();
        $order_action->order_id        = $id;
        $order_action->action_user     = $user->name;
        $order_action->order_status    = $order->order_status;
        $order_action->shipping_status = $order->shipping_status;
        $order_action->pay_status      = $order->pay_status;
        $order_action->action_note     = $action_note;
        $order_action->action_place    = 1;
        $order_action->log_time        = time();
        $order_action->save();
    }

}

if (!function_exists('order_action_zq')) {
    function order_action_zq($action, $order, $action_note = '')
    {
        $user                       = session_admin();
        $order_action               = $action;
        $order_action->order_id     = $order->zq_id;
        $order_action->action_user  = $user->name;
        $order_action->order_status = $order->order_status;
        $order_action->pay_status   = $order->pay_status;
        $order_action->action_note  = $action_note;
        $order_action->log_time     = time();
        $order_action->save();
    }

}

if (!function_exists('pay_options')) {
    function pay_options()
    {
        $arr = [
            '合纵线下' => '合纵线下',
            '成都银行' => '成都银行',
            '对公农行' => '对公农行',
            '邮政'   => '邮政',
            '农商'   => '农商',
            '中行'   => '中行',
            '兴业银行' => '兴业银行',
            '支付宝'  => '支付宝',
            '对公建行' => '对公建行',
            '对公工行' => '对公工行',
            '民生银行' => '民生银行',
        ];
        return $arr;
    }

}

if (!function_exists('_array_map')) {
    function _array_map($fun = 'trim', $arr)
    {
        $arr = array_map($fun, $arr);
        return $arr;
    }

}


if (!function_exists('get_order_sn')) {
    function get_order_sn()
    {
        $is_order_exist = true; //标识，默认订单号已经存在
        $order_sn       = '';
        do {
            $order_sn = date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
            $time     = strtotime(date('Ymd'));
            $count    = \App\Models\OrderInfo::where('order_sn', $order_sn)->where('add_time', '>', $time)->count();
            if (empty($count)) {
                //如果计数为0
                $is_order_exist = false;
            }
        } while ($is_order_exist);
        return $order_sn;
    }
}

if (!function_exists('ddbz')) {

    function ddbz($order)
    {
        $ddbz = '<span style="color: red">%s</span>';
        $str  = '';
        if ($order->is_xkh == 1) {
            $str .= '<img src="' . get_img_path('images/newkh.gif') . '">';
        }
        if ($order->is_mhj == 1) {
            $str .= '麻';
        } elseif ($order->is_mhj == 2) {
            if ($order->order_id > 380700) {
                $str .= '白';
            } else {
                $str .= '控';
            }
        }
        if ($order->is_zq > 0) {
            $str .= '账';
        }
        if ($order->mobile_pay >= 2) {
            $str .= '业';
        }
        if ($order->is_admin >= 1) {
            $str .= 'ad';
        }
        if ($order->mobile_pay == 3) {
            $str .= '控';
        }
        if ($order->mobile_pay == 9) {
            $str .= '5';
        }
        if ($order->mobile_pay == 10) {
            $str .= '6';
        }
        if ($order->mobile_pay == 11) {
            $str .= '7';
        }
        if ($order->bonus_id == 3) {
            $str .= '葵';
        }
        if ($order->bonus_id == 2) {
            $str .= '太';
        }
        if ($order->is_separate == 1) {
            $str .= '货';
        }
        if ($order->mobile_pay == 1) {
            $str .= '手';
        }
        if ($order->jnmj > 0) {
            $str .= '返';
        }
        if (!empty($str)) {
            $order->ddbz = sprintf($ddbz, $str);
        } else {
            $order->ddbz = '';
        }
        return $order;
    }
}

if (!function_exists('db_connect')) {
    function db_connect()
    {
        return 'mysql';
    }
}

if (!function_exists('log_mhj_number')) {
    function log_mhj_number($mhj_number, $sn, $user_id)
    {
        $log_info              = new \App\Models\MhjNumberLog();
        $log_info->user_id     = $user_id;
        $log_info->mhj_number  = $mhj_number;
        $log_info->change_desc = $sn;
        $log_info->change_type = 0;
        $log_info->save();
    }
}

if (!function_exists('curl_yyg')) {
    function curl_yyg($url)
    {
        $ch = curl_init();
        // 2. 设置选项，包括URL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        // 3. 执行并获取HTML文档内容
        $output = curl_exec($ch);
        // 4. 释放curl句柄
        curl_close($ch);
    }
}

if (!function_exists('pc_url')) {
    function pc_url($url)
    {
        $pc_url = "http://www.hezongyy.com/";
        return $pc_url . $url;
    }
}

if (!function_exists('updateBatch')) {
    function updateBatch($tableName = "", $multipleData = array())
    {

        if ($tableName && !empty($multipleData)) {

            // column or fields to update
            $updateColumn    = array_keys($multipleData[0]);
            $referenceColumn = $updateColumn[0]; //e.g id
            unset($updateColumn[0]);
            $whereIn = "";

            $q = "UPDATE " . $tableName . " SET ";
            foreach ($updateColumn as $uColumn) {
                $q .= $uColumn . " = CASE ";

                foreach ($multipleData as $data) {
                    $q .= "WHEN " . $referenceColumn . " = " . $data[$referenceColumn] . " THEN '" . $data[$uColumn] . "' ";
                }
                $q .= "ELSE " . $uColumn . " END, ";
            }
            foreach ($multipleData as $data) {
                $whereIn .= "'" . $data[$referenceColumn] . "', ";
            }
            $q = rtrim($q, ", ") . " WHERE " . $referenceColumn . " IN (" . rtrim($whereIn, ', ') . ")";

            // Update
            return DB::update(DB::raw($q));

        } else {
            return false;
        }
    }
}

if (!function_exists('bj_time')) {
    function bj_time($time, $format = '')
    {
        $lj_time = \Carbon\Carbon::createFromTimestamp(0);
        if ($time->eq($lj_time)) {
            $time = '';
        } else {
            if (!empty($format)) {
                $time = $time->format($format);
            }
        }
        return $time;
    }
}

if (!function_exists('qckg')) {
    function qckg($str, $fh = '')
    {
        if (!empty($fh)) {
            $str = trim($str, $fh);
        } else {
            $str = trim($str);
        }
        return preg_replace("/(\s|\&nbsp\;|　|\xc2\xa0)/", "", $str);
    }
}

if (!function_exists('jyfw')) {
    function jyfw()
    {
        $arr = [
            'Ⅲ类医疗器械', 'II类医疗器械', '蛋白同化制剂及肽类激素', '化学原料药',
            '乳制品(含婴幼儿配方乳粉)', '生物制品（不含预防性）', '食品',
            '特殊药品复方制剂', '体外诊断试剂', '中药材', '中药饮片', '终止妊娠药物',
            '冷藏药品', '血液制品'
        ];
        return $arr;
    }
}

if (!function_exists('cs_user')) {
    function cs_user()
    {
        $arr = [22790, 20051, 18868, 18864, 18810, 18809, 16436,
            14415, 13960, 13959, 12567, 3442, 2404];
        return $arr;
    }
}
