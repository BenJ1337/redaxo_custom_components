<?php

namespace redaxo_custom_components;

use rex_sql, rex, rex_path;

class Module
{
    private $id;
    private $key;
    private $name;
    private $input;
    private $output;
    private $createdate;
    private $createuser;
    private $updatedate;
    private $updateuser;
    private $attributes;
    private $revision;

    function __construct($id, $key, $name, $input, $output, $createdate, $createuser, $updatedate, $updateuser, $attributes, $revision)
    {
        $this->id = $id;
        $this->key = $key;
        $this->name = $name;
        $this->input = $input;
        $this->output = $output;
        $this->createdate = $createdate;
        $this->createuser = $createuser;
        $this->updatedate = $updatedate;
        $this->updateuser = $updateuser;
        $this->attributes = $attributes;
        $this->revision = $revision;
    }

    // Getter methods
    public function getId()
    {
        return $this->id;
    }

    public function getKey()
    {
        return $this->key;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getInput()
    {
        return $this->input;
    }

    public function getOutput()
    {
        return $this->output;
    }

    public function getCreatedate()
    {
        return $this->createdate;
    }

    public function getCreateuser()
    {
        return $this->createuser;
    }

    public function getUpdatedate()
    {
        return $this->updatedate;
    }

    public function getUpdateuser()
    {
        return $this->updateuser;
    }

    public function getAttributes()
    {
        return $this->attributes;
    }

    public function getRevision()
    {
        return $this->revision;
    }
}


class SyncService
{

    private  $modulename;

    function __construct(string $modulename)
    {
        $this->modulename = $modulename;
    }

    /**
     * @return Module[]
     */
    public static function getModules(): array
    {
        $result = array();
        $rexSql = rex_sql::factory();
        $rows = $rexSql->getArray('SELECT * FROM ' . rex::getTablePrefix() . 'module');
        foreach ($rows as $module) {
            $result[$module["id"]] = new Module(
                $module["id"],
                $module["key"],
                $module["name"],
                $module["output"],
                $module["input"],
                $module["createdate"],
                $module["createuser"],
                $module["updatedate"],
                $module["updateuser"],
                $module["attributes"],
                $module["revision"],
            );
        }
        return $result;
    }

    private function getIdsOfExistingModules(): array
    {
        $existingModules = array();
        foreach (self::getModules() as $key => $module) {
            if (null !== $module->getAttributes()) {
                $attr = json_decode($module->getAttributes(), true);
                if (isset($attr['redaxo_custom_components'])) {
                    $existingModules[] = $key;
                };
            }
        }
        return $existingModules;
    }

    public function checkUsages(int $id): bool
    {
        $rexSql = rex_sql::factory();
        $rows = $rexSql->getArray('SELECT COUNT(*) as count FROM ' . rex::getTablePrefix() . 'article_slice WHERE module_id = ' . $id);
        return $rows[0]['count'] > 0;
    }

    public function deleteAll(): void
    {
        $IdsOfExistingModules = $this->getIdsOfExistingModules();
        $IdsOfModulesToDelete = array();
        foreach ($IdsOfExistingModules as $id) {
            if (!$this->checkUsages($id)) {
                $IdsOfModulesToDelete[] = $id;
            }
        }
        if (!empty($IdsOfModulesToDelete)) {
            $this->delete($IdsOfModulesToDelete);
        }
    }

    public function copyModules(): void
    {

        $existingModules = $this->getIdsOfExistingModules();

        $dir = rex_path::addon($this->modulename);
        $modulesDir = $dir . 'modules/';
        $moduleDirs = array_diff(scandir($modulesDir), array('..', '.'));
        foreach ($moduleDirs as $moduleDir) {
            if (!str_starts_with($moduleDir, '.')) {
                self::insertModule(
                    $moduleDir,
                    '<?php include(rex_path::addon("redaxo_custom_components", "modules/' . $moduleDir . '/input.php"));',
                    '<?php $sliceId = REX_SLICE_ID; include(rex_path::addon("redaxo_custom_components", "modules/' . $moduleDir . '/output.php"));'
                );
            }
        }
    }



    private function insertModule(string $mname, string $eingabe, string $ausgabe)
    {
        $rexSql = rex_sql::factory();
        $rexSql->setTable(rex::getTablePrefix() . 'module');
        $rexSql->setValue('name', $mname);
        $rexSql->setValue('attributes', json_encode(array($this->modulename => $this->modulename)));
        $rexSql->setValue('input', $eingabe);
        $rexSql->setValue('output', $ausgabe);
        $rexSql->addGlobalCreateFields();
        $rexSql->insert();
    }

    private function updateModule(string $mname, string $moduleKey, string $eingabe, string $ausgabe)
    {
        $rexSql = rex_sql::factory();
        $rexSql->setTable(rex::getTablePrefix() . 'module');
        $rexSql->setValues(array(
            'name' => $mname,
            'input' => $eingabe,
            'output' => $ausgabe
        ));
        $rexSql->addGlobalUpdateFields();
        $rexSql->setWhere('`key` = :key', array('key' => $moduleKey));
        $rexSql->update();
    }

    public function delete(array $moduleKeys): bool
    {
        $param = array();
        $where = '';
        foreach ($moduleKeys as $value) {
            $params['param_' . $value] = $value;
            if (!empty($where)) {
                $where .= ' || ';
            }
            $where .= "id = :id_" . $value;

            $param['id_' . $value] = $value;
        }
        $rexSql = rex_sql::factory();
        $rexSql->setTable(rex::getTablePrefix() . 'module');
        $rexSql->setWhere($where, $param);
        $rexSql->delete();
        return $rexSql->getRows() === 1;
    }
}
