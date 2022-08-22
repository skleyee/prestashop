<?php


class Student extends ObjectModel
{
    public $id;

    public $name;

    public $birthday;

    public $is_studies;

    public $GPA;

    public static $definition = [
        'table'   => 'student',
        'primary' => 'id_student',
        'fields'  => [
            'name'       => ['type' => self::TYPE_STRING, 'size' => 255],
            'birthday'   => ['type' => self::TYPE_DATE],
            'is_studies' => ['type' => self::TYPE_BOOL, 'validate' => 'isBool'],
            'GPA'        => ['type' => self::TYPE_FLOAT]
        ]
    ];

    public function __construct($name = null, $birthday = null, $is_studies = null, $GPA = null)
    {
        $this->name = $name;
        $this->birthday = $birthday;
        $this->is_studies = $is_studies;
        $this->GPA = $GPA;
        parent::__construct();
    }

    public function add($auto_date = true, $null_values = false)
    {
        return parent::add($auto_date, $null_values);
    }


    public static function getAll()
    {
        $db = Db::getInstance();
        $sql = 'SELECT `name` FROM `' . _DB_PREFIX_ . 'student` s';
        return $db->executeS($sql) ?? [];
    }

    public static function getBestGpa()
    {
        $db = Db::getInstance();
        $sql = 'SELECT MAX(GPA) as best_gpa FROM `' . _DB_PREFIX_ . 'student` s';
        return $db->executeS($sql)[0]['best_gpa'] ?? null;
    }

    public static function getBestStudentByGPA()
    {
        $db = Db::getInstance();
        $sql = 'SELECT `name` FROM `' . _DB_PREFIX_ . 'student` s WHERE s.GPA =' . self::getBestGpa();
        return $db->executeS($sql)[0] ?? null;
    }

}