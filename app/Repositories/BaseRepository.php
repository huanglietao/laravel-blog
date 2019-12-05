<?php namespace App\Repositories;

abstract class BaseRepository {

	/**
	 * The Model instance.
	 *
	 * @var Illuminate\Database\Eloquent\Model
	 */
	protected $model;

	/**
	 * 获取主model条数.
	 *
	 * @return array
	 */
	public function getNumber()
	{
		$total = $this->model->count();


		return compact('total');
	}

	/**
	 * Destroy a model.
	 *
	 * @param  int $id
	 * @return void
	 */
	public function destroy($id)
	{
		$this->getById($id)->delete();
	}

	/**
	 * Get Model by id.
	 *
	 * @param  int  $id
	 * @return App\Models\Model
	 */
	public function getById($id)
	{
		return $this->model->findOrFail($id);
	}

    /**
     * 生成密码
     * @param $pwd 明文密码
     * @param string $salt 密码盐值
     * @return string
     */
	protected function setPassword($pwd, $salt = '')
    {
        return md5($pwd.$salt);
    }


}
