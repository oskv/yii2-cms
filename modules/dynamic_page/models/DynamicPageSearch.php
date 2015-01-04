<?php

/**
 * @property integer $id
 * @property string $name
 * @property string $text
 * @property string $dt_created
 * @property integer $display
 * @property integer $public
 */

namespace app\modules\dynamic_page\models;

use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;

class DynamicPageSearch extends DynamicPage
{
	public function rules()
	{
		return [
			[['name'], 'safe'],
		];
	}

	public function search($params)
	{
		$query = self::find();

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
			'pagination' => [
				'pageSize' => 10,
			]
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$query->andFilterWhere(['like', 'name', $this->name]);

		return $dataProvider;
	}
}