<?php
/**
 * Created by PhpStorm.
 * User: Larry
 * Date: 16/6/15
 * Time: 14:12
 */
namespace App\Models;

use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Model;
use DB;
class BaseModel extends  Model
{

    public function __construct()
    {
        parent::__construct();
    }


    /**
     * 仓储或model 使用return $query->multiWhere($map)->paginate($numPerPage);
     * 调用方式$map['category_pid'] = ['=', $type];
     * 多条件查询where
     * @return mixed
     * 2015-9-21 添加
     */
    public function scopeMultiWhere($query, $arr = '')
    {
        if (!is_array($arr) || empty($arr)) {
            return $query;
        }

        foreach ($arr as $key => $value) {
            //判断$arr
            if (is_array($value)) {
                $value[0] = strtolower($value[0]);
                switch ($value[0]) {
                    case 'like';
                        $query = $query->where($key, 'like', $value[1]);
                        break;
                    case 'in':
                        $query = $query->whereIn($key, $value[1]);
                        break;
                    case 'between':
                        $query = $query->whereBetween($key, [$value[1][0], $value[1][1]]);
                        break;
                    case 'glt'://大于小于等于比较查询   $where['money'] = ['glt',[['>',1],['<=',2]]];
                        $query = $query->where($key, $value[1][0][0], $value[1][0][1])->where($key, $value[1][1][0], $value[1][1][1]);
                        break;
                    default:
                        $query = $query->where($key, $value[0], $value[1]);
                        break;
                }
            } else {
                $query = $query->where($key, $value);
            }
        }
        return $query;
    }

    public function scopeWithOnly($query, $relation, Array $columns)
    {
        return $query->with([$relation => function ($query) use ($columns) {
            $query->select($columns);
        }]);
    }

    public function scopeMultiSelect($query, $fields = '')
    {
        if (empty($fields)) {
            $fields = '*';
        }
        if (is_array($fields)) {
            $fields = implode(',', $fields);
        }
        return $query->select(DB::raw((string)$fields));
    }

    /**
     * 仓储或model 使用return $query->multiOrder($order)->paginate($numPerPage);
     * 调用方式$order['created_at'] = 'desc';
     * 多条件排序order
     * @return mixed
     * 2016-3-7 添加
     */
    public function scopeOrder($query, $orders = null)
    {
        if (!is_array($orders) || is_null($orders)) {
            return $query;
        }

        foreach ($orders as $key => $value) {
            $query = $query->orderBy($key, $value);
        }
        return $query;
    }

    /**
     * 添加数据
     * @param $data
     */
    protected function _add($data){
        try {
            return $this->insertGetId($data);
        } catch(\Illuminate\Database\QueryException $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 删除数据
     * @param $where
     * @return mixed
     */
    protected function _del( $where){
        return $this->multiWhere($where)->delete();
    }
    /**
     * 修改数据
     * @param array $where
     * @param array $data
     * @return mixed
     */
    protected function _updata($where, $data){
        return $this->multiWhere($where)->update($data);
    }

    /**
     * 根据条件获取用户信息
     * @param $where
     * @param string $fields
     * @return mixed
     */
    protected function _getOne($where, $fields = "*"){
        return $this->select($fields)->multiWhere($where)->first();
    }

    /**
     * 获取分页数据
     * @param array $where
     * @param string $fields
     * @param array $order
     * @param int $pagesize
     * @return mixed
     */
    protected function getPaginate($where = [], $fields = "*", $order = ['created_at' => 'desc'],  $pagesize = 10)
    {
        return $this->select($fields)->multiWhere($where)->order($order)->paginate($pagesize);
    }

    /**
     * 获取分页数据
     * @param array $where
     * @param string $fields
     * @param array $order
     * @param int $pagesize
     * @return mixed
     */
    protected function getPaginate2($where = [], $fields = "*", $order = ['created_at' => 'desc'],  $pagesize = 10)
    {
        return $this->select($fields)->multiWhere($where)->order($order)->paginate($pagesize);
    }
    /**
     * 获取全部数据
     * @param array $where
     * @param string $fields
     * @param array $order
     * @return mixed
     */
    public function getAll($where = [], $fields = "*", $order = ['created_at' => 'desc'])
    {
        return $this->select($fields)->multiWhere($where)->order($order)->get();

    }



    /**
     * 仓储或model 使用return $query->multiOrder($order)->paginate($numPerPage);
     * 调用方式$order['created_at'] = 'desc';
     * 多条件排序order
     * @return mixed
     * 2016-3-7 添加
     */
    public function scopeMultiOrder($query, $orders = '')
    {
        if (!is_array($orders)) {
            return $query;
        }
        if (empty($orders)) {
            return $query;
        }
        foreach ($orders as $key => $value) {
            $query = $query->orderBy($key, $value);
        }
        return $query;
    }

    public function getCount($where = [])
    {
        return $this->multiWhere($where)->count();
    }

    public function getSum($where = [],$field = "*")
    {
        return $this->multiWhere($where)->sum($field);
    }
    /**
     * 获取全部数据
     * @param array $where
     * @param string $fields
     * @param array $order
     * @return mixed
     */
    public function getPluck($where = [], $fields = "*", $order = ['created_at' => 'desc'])
    {
        //dd($this->pluck("name"));
        return $this->multiWhere($where)->order($order)->pluck('name', 'id');

        //return $this->multiWhere($where)->order($order)->get(['id', DB::raw('name as text')]);
    }
}