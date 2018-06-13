<?php

abstract class AR // похоже на ActiveRecord
{
	public function __construct($attrs = [])
	{
		foreach (array_keys(static::ATTRIBUTES) as $attr_name) {
			if (isset($attrs[$attr_name])) {
				$this->setAttr($attr_name, $attrs[$attr_name]);
				unset($attrs[$attr_name]);
			}
		}
		if (!empty($attrs))
			throw new InvalidArgumentException('Лишние атрибуты: '.implode(', ', array_keys($attrs)));
	}
	
	public function setAttr($name, $value)
	{
		if (isset(static::ATTRIBUTES[$name]))
			$this->$name = $value;
		else
			throw new InvalidArgumentException('Неизвестное поле: '.$name);
	}
	
	public function getAttr($name)
	{
		if (isset(static::ATTRIBUTES[$name]))
			return $this->$name;
		else
			throw new InvalidArgumentException('Неизвестное поле: '.$name);
	}
	
	public function create()
	{
		$db = DBH::getInstance()->db;
		$filled_attrs = array_filter(array_keys(static::ATTRIBUTES), function($el) { return isset($this->$el); });
		$filled_attrs_str = implode(', ', $filled_attrs);
		$placeholders = str_repeat('?,', count($filled_attrs) - 1) . '?';
		$values = array_map(function($el) { return $this->$el; }, $filled_attrs);
		$types = [];
		
		foreach (static::ATTRIBUTES as $attr_name => $type) {
			if (in_array($attr_name, $filled_attrs))
				$types[] = $type;
		}
		
		$tbl = static::TABLE_NAME;
		$query = "INSERT INTO $tbl ($filled_attrs_str) VALUES ($placeholders)";
		//var_dump($query);var_dump($filled_attrs);var_dump($values);var_dump(implode('', $types));
		
		$st = $db->prepare($query);
		$st->bind_param(implode('', $types), ...$values);
		if (!$st->execute())
			throw new Exception($st->error);
	}
	
	public function update($original_id)
	{
		$db = DBH::getInstance()->db;
		$list = array_map(function($el) { return "$el = ?"; }, array_keys(static::ATTRIBUTES));
		$attrs = implode(', ', $list);
		$values = array_map(function($el) { return $this->$el; }, array_keys(static::ATTRIBUTES));
		$values[] = $original_id;
		$types = implode('', array_values(static::ATTRIBUTES)) . static::ATTRIBUTES['id'];
		
		$tbl = static::TABLE_NAME;
		$query = "UPDATE $tbl SET $attrs WHERE id = ?";
		
		$st = $db->prepare($query);
		$st->bind_param($types, ...$values);
		if (!$st->execute())
			throw new Exception($st->error);
	}
	
	public static function delete_object($id)
	{
		$db = DBH::getInstance()->db;
		$tbl = static::TABLE_NAME;
		
		$st = $db->prepare("DELETE FROM $tbl WHERE id = ?");
		$st->bind_param(static::ATTRIBUTES['id'], $id);
		if (!$st->execute())
			throw new Exception($st->error);
	}
}
