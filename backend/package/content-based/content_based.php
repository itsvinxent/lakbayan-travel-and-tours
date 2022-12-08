<?php

/**
 * PHP item based filtering
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * @package   PHP item based filtering
 */
class ContentBasedRecommend extends Recommend
{
	const USER_ID = '__USER__';
	protected $data;

	function __construct($user, $objects)
	{
		$this->data[self::USER_ID] = $this->processUser($user);
		$this->data = array_merge($this->data, $this->processObjects($objects));
	}

	public function getRecommendation()
	{
		$result = [];

		foreach ($this->data as $k => $v) {
			if($k !== self::USER_ID) {
				$result[$k] = $this->similarityDistance($this->data, self::USER_ID, $k);
			}
		}

		arsort($result);
		return $result;
	}

	protected function processUser($user)
	{
		$result = [];

		foreach ($user as $tag) {
			$result[$tag] = 1.0;
		}

		return $result;
	}

	protected function processObjects($objects)
	{
		$result = [];

		foreach ($objects as $object => $tags) {
			foreach ($tags as $tag) {
				$result[$object][$tag] = 1.0	;
			}
		}

		return $result;
	}
}